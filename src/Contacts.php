<?php

namespace Mikhey;

use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;

class Contacts
{
    private const CONTACTS_MESSAGE = <<<Text
+7-996-316-07-09 (RU)
Telegram https://t.me/mbrody
Text;

    public static function show($chat_id)
    {
        $keyboard = new Keyboard(['К портфолио', '']);

        $keyboard
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true);
        $data = [
            'text' => self::CONTACTS_MESSAGE,
            'chat_id' => $chat_id,
            'reply_markup' => $keyboard
        ];

        return Request::sendMessage($data);
    }
}