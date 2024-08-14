FROM python:3.12-alpine

RUN pip install flask \
    flask_cors \
    gunicorn \
    requests \
    pymongo \
    uuid
RUN pip freeze > requirements.txt

WORKDIR /var/www/application