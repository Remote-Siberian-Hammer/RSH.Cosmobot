from uuid import uuid4
from core.events import EventType, EventMessage


class EventHandler:
    def __init__(self, meta):
        self.meta = meta

    def eventMessageFormat(self, event_type: EventType) -> any:
        match event_type.value:
            case 1:
                return EventMessage(
                    id=uuid4().hex,
                    message_id=self.meta.get_json()['message']['message_id'],
                    chat_id=self.meta.get_json()['message']['chat']['id'],
                    user_id=self.meta.get_json()['message']['from']['id'],
                    username=self.meta.get_json()['message']['from']['username'],
                    text=self.meta.get_json()['message']['text'],
                    attachments=list()
                )
            case _:
                pass

    def handler(self) -> EventMessage:
        print(self.meta.get_json())
        message = self.meta.get_json()['message']
        if message["chat"]["id"] > 0 and "text" in message.keys():
            return self.eventMessageFormat(EventType.USER_MESSAGE)
