from json import load
from core.bot import Bot
from core.const import TG_SERVER, TG_ACTIONS
from requests import post


def sendler(payload, bot: Bot):
    url = TG_SERVER.format(TOKEN=bot.access_token) + TG_ACTIONS['send']
    return post(url, json=payload)
