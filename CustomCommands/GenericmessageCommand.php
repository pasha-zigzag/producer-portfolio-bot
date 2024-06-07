<?php

namespace Longman\TelegramBot\Commands\CustomCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Mikhey\WorksMenu;

class GenericmessageCommand extends SystemCommand
{
    protected $name = 'genericmessage';
    protected $description = 'Handle generic messages';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $message->getText(true);

        switch ($text) {
            case 'К портфолио':
                return WorksMenu::show($chat_id);
        }

        return Request::emptyResponse();
    }
}