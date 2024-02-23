FROM python:3.12-alpine

RUN pip install flask \
    gunicorn \
    requests \
    pymongo \
    uuid
RUN pip freeze > requirements.txt

WORKDIR /var/www/bot
