from uuid import uuid4
from typing import List
from pymongo import MongoClient
from app.sendler import sendler
from core.const import TG_KEYBOARD_TEMPLATE
from core.message import Button, Message
from core.bot import Bot
from core.events import EventMessage
from core.storage import UserDialogStepIdentity
from services.button_generate_service import ButtonGenerateService


class Chain:
    def getUserStep(self, application_context: MongoClient, chat_id: int) -> UserDialogStepIdentity:
        context = application_context['cosmobot_storage']['chain_steps'].find_one({"chat_id": chat_id})
        return UserDialogStepIdentity(
            id=context["id"],
            chat_id=context["chat_id"],
            next_step=context["next_step"]
        )

    def setUserStep(self, application_context: MongoClient, storage: UserDialogStepIdentity):
        return application_context['cosmobot_storage']['chain_steps'].insert_one(storage.__dict__)

    def reloadUserStep(self, application_context: MongoClient, storage: UserDialogStepIdentity):
        return application_context['cosmobot_storage']['chain_steps'].update_one({
            "chat_id": storage.chat_id}, {"$set": {"next_step": storage.next_step}})

    def branchPointByStep(self, step: int, messages_chain: list):
        step_variable = []
        if messages_chain[step]['next_step']:
            step_variable.append({'text': messages_chain[step]['next_step']})
        for button in messages_chain[step]['buttons']:
            if button['next_step'] is not None:
                step_variable.append({'button': {'text': button['text'], 'next_step': button['next_step']}})
        return step_variable


class MessageChainProcessingService(Chain):
    bot: Bot
    applicationContext: MongoClient

    def __init__(self, bot: Bot, application_context: MongoClient):
        super().__init__()
        self.bot = bot
        self.applicationContext = application_context

    def formatMessage(self, message: dict, buttons: List[Button]) -> Message:
        return Message(
            chat_id=message.chat_id,
            text=message.text,
            buttons=[button for button in buttons],
            next_step=message.next_step
        )

    @classmethod
    def reply_markup_call(cls):
        pass

    @classmethod
    def inline_keyboard_call(cls):
        pass

    def call(self, event_action: EventMessage, messages_chain: list):
        message = self.applicationContext['cosmobot_storage']['chains'].insert_one(event_action.__dict__)
        if message.inserted_id:
            try:
                context = self.getUserStep(self.applicationContext, event_action.chat_id)
                # Проверка кнопок
                for step in self.branchPointByStep(context.next_step, messages_chain):
                    if 'button' in step.keys():
                        if step['button']['text'] == event_action.text:
                            for chain in messages_chain:
                                if chain['id'] == step['button']['next_step']:
                                    buttons = ButtonGenerateService(
                                        TG_KEYBOARD_TEMPLATE,
                                        chain["buttons"]
                                    )
                                    buttons.generateButton()
                                    sendler({
                                        'chat_id': event_action.chat_id,
                                        'text': chain["text"],
                                        'reply_markup': buttons.keyboard_reply_template,
                                        # 'reply_markup': {
                                        #     'inline_keyboard': buttons.keyboard_inline_template['keyboard']}
                                    }, self.bot)
                                    # Обновление шага
                                    self.reloadUserStep(
                                        self.applicationContext,
                                        UserDialogStepIdentity(
                                            id=None,
                                            chat_id=event_action.chat_id,
                                            next_step=step['button']['next_step']
                                        )
                                    )
                                    # Очистка кнопок, для избежания дублирования
                                    TG_KEYBOARD_TEMPLATE["keyboard"] = list()
            except TypeError:
                step = 0
                while step == 0:
                    if self.setUserStep(
                        self.applicationContext,
                        UserDialogStepIdentity(
                            id=uuid4().hex,
                            chat_id=event_action.chat_id,
                            next_step=messages_chain[step]["id"]
                        )
                    ).inserted_id:
                        # Генерация кнопок на основе шага
                        buttons = ButtonGenerateService(TG_KEYBOARD_TEMPLATE, messages_chain[step]["buttons"])
                        buttons.generateButton()
                        sendler({
                            'chat_id': event_action.chat_id,
                            'text': messages_chain[step]["text"],
                            'reply_markup': buttons.keyboard_reply_template,
                            # 'reply_markup': {'inline_keyboard': buttons.keyboard_inline_template['keyboard']}
                        }, self.bot)
                        # Очистка кнопок, для избежания дублирования
                        TG_KEYBOARD_TEMPLATE["keyboard"] = list()
                    break
