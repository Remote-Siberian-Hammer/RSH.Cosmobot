from json import load
from flask import Flask, request, jsonify
from flask_cors import CORS, cross_origin
from pymongo import MongoClient
from bson import ObjectId
from app.handler import EventHandler
from app.sendler import sendler
from core.bot import Bot
from services.message_chain_processing_service import MessageChainProcessingService


app = Flask(__name__)
# ------------------------------------------------
# Добавление заголовков передачи данных с других хостов
# ------------------------------------------------
cors = CORS(app, resources={r"/*": {"origins": "*"}}, headers='Content-Type')
app.config['CORS_HEADERS'] = 'Content-Type'
# ------------------------------------------------
# Подруб монго
# ------------------------------------------------
client = MongoClient('172.18.0.1', 27017, username='raptor', password='lama22')
client.admin.command('ping')


@app.route('/', methods=['GET', 'POST'])
def main():
    try:
        fn = client['cosmobot_storage']['bots'].find_one({'_id': ObjectId('65db2fb9cd348ea0aef26496')})
        bot = Bot(
            fn['info']['name'],
            'Telegram',
            fn['info']['platforms']['tg']
        )
    except Exception:
        fn = load(open('app/bin/bot-HASH-NAME.json', 'r'))
        bot = Bot(
            fn['info']['name'],
            'Telegram',
            fn['info']['platforms']['tg']
        )
    event_handler = EventHandler(request)
    action = MessageChainProcessingService(bot, client)
    try:
        action.call(event_handler.handler(), messages_chain=fn["messages_chain"])
    except Exception as e:
        action.call(event_handler.handler(), messages_chain=bot["messages_chain"])
    return str()


@app.route('/api/bot/registration', methods=['GET', 'POST'])
@cross_origin()
def bot_registration(request=request):
    # TODO: Провалидировать данные
    client['cosmobot_storage']['bots'].insert_one(request.json)
    print(request.json)
    return str()


# https://api.telegram.org/bot6742010369:AAEDGXt3ctqOSdtWFOlG6SH_00WUrNkwlS4/setWebhook?url=https://eohn54baow.loclx.io
if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True, port=5000)
