<?php

namespace Mikhey\Callback;

use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class Router
{
    public function route(CallbackQuery $callback_query): ServerResponse
    {
        $callback_data  = $callback_query->getData();
        $chat_id        = $callback_query->getMessage()->getChat()->getId();
        $callback_query_id = $callback_query->getId();

        switch ($callback_data) {
            case '/contacts':
                $response_text = 'You clicked Button 1';
                break;
            case '/works':
                $response_text = 'You clicked Button 2';
                break;
            default:
                $response_text = 'Unknown button';
                break;
        }

        // Answer callback query
        $data = [
            'callback_query_id' => $callback_query_id,
            'text'              => $response_text,
            'show_alert'        => false, // Set to true if you want to show an alert
        ];
        Request::answerCallbackQuery($data);

        // Send message with the response text
        $data = [
            'chat_id' => $chat_id,
            'text'    => $response_text,
        ];
        return Request::sendMessage($data);
    }
}