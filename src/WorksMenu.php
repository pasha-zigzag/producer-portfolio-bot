<?php

namespace Mikhey;

namespace Mikhey;

use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class WorksMenu
{
    private const WORKS_MESSAGE = 'Выбери музыкальное направление';

    public static function show($chat_id): ServerResponse {
        $keyboard = new InlineKeyboard(
            [
                [
                    'text' => 'Rock/Blues-Rock/Alternative',
                    'callback_data' => '/rock'
                ],
                [
                    'text' => 'Indie/Pop',
                    'callback_data' => '/pop'
                ],
            ],
            [
                [
                    'text' => 'Live/концерты',
                    'callback_data' => '/live'
                ],
            ],
        );

        $data = [
            'text' => self::WORKS_MESSAGE,
            'reply_markup' => $keyboard,
            'chat_id' => $chat_id,
        ];

        return Request::sendMessage($data);
    }
}