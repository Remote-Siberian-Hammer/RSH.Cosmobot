from flask import Flask


app = Flask(__name__)

# https://api.telegram.org/bot6742010369:AAEDGXt3ctqOSdtWFOlG6SH_00WUrNkwlS4/setWebhook?url=https://eohn54baow.loclx.io
if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True, port=9000)
