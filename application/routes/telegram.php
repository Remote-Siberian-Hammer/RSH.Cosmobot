<?php
/** @var SergiX44\Nutgram\Nutgram $bot */
use SergiX44\Nutgram\Nutgram;
use App\Http\Controllers\Api\Bot\CreateAccountController;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

# sudo docker-compose run artisan nutgram:run
$bot->onCommand('start', function (Nutgram $bot) { CreateAccountController::start($bot); });
$bot->onText('Авторизоваться', function (Nutgram $bot) { CreateAccountController::getUser($bot); });
