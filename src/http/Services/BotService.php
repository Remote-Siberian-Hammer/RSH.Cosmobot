<?php

namespace http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

require_once dirname(__DIR__, 2) . '/domain/const.php';


class BotService
{
    private Client $_httpClient;
    public function __construct(Client $httpClient)
    {
        $this->_httpClient = $httpClient;
    }
    public function queryCreateBot(array $botContext): ResponseInterface
    {
        return  $this->_httpClient->post(
            "{BOT_API_BASE_URL}/api/bot/registration",
            [
                'body' => [
                    'owner_id' => $_COOKIE['user_id'],
                    'bot' => $botContext
                ]
            ]
        );
    }
}