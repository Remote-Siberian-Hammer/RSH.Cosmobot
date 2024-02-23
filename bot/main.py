from json import load
from flask import Flask, request
from pymongo import MongoClient
from app.handler import EventHandler
from app.sendler import sendler
from core.bot import Bot
from services.message_chain_processing_service import MessageChainProcessingService


app = Flask(__name__)
client = MongoClient('172.18.0.1', 27017, username='raptor', password='lama22')
client.admin.command('ping')


@app.route('/', methods=['GET', 'POST'])
def main():
    fn = load(open('app/bin/bot-HASH-NAME.json', 'r'))
    bot = Bot(
        fn['info']['name'],
        'Telegram',
        fn['info']['platforms']['tg']
    )
    # if request.method == 'POST':
    event_handler = EventHandler(request)
    action = MessageChainProcessingService(bot, client)
    action.call(event_handler.handler(), messages_chain=fn["messages_chain"])
    return "hello"


# https://api.telegram.org/bot6742010369:AAEDGXt3ctqOSdtWFOlG6SH_00WUrNkwlS4/setWebhook?url=https://xv81gudcfq.loclx.io
if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True, port=5000)