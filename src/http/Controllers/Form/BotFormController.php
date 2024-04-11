<?php

namespace http\Controllers\Form;

use Http\Services\BotService;


class BotFormController
{
    private BotService $_botService;
    public function __construct(BotService $botService)
    {
        $this->_botService = $botService;
    }
    public function registration(array $context): void
    {
        //TODO: Проверить данные
        if ($this->_botService->queryCreateBot($context))
        {
            // TODO: перенаправить на "Мои боты"
            header("Location: /");
            exit();
        }
    }
}