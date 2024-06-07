<?php

namespace Longman\TelegramBot\Commands\CustomCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Mikhey\Contacts;
use Mikhey\WorksMenu;

class CallbackqueryCommand extends SystemCommand
{
    protected $name = 'callbackquery';
    protected $description = 'Handle callback query';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $callback_query = $this->getCallbackQuery();
        $callback_data  = $callback_query->getData();
        $chat_id        = $callback_query->getMessage()->getChat()->getId();
        $callback_query_id = $callback_query->getId();

        $data = [
            'callback_query_id' => $callback_query_id,
            'show_alert'        => false,
        ];
        Request::answerCallbackQuery($data);

        switch ($callback_data) {
            case 'contacts':
                return Contacts::show($chat_id);
            case 'works':
                return WorksMenu::show($chat_id);
        }

        return Request::sendMessage(['chat_id' => $chat_id, 'text' => 'Неизвестная команда']);
    }
}