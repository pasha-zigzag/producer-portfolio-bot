<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 *
 * When using deep-linking, the parameter can be accessed by getting the command text.
 *
 * @see https://core.telegram.org/bots#deep-linking
 */

namespace Longman\TelegramBot\Commands\CustomCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\InlineKeyboardButton;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    private const MESSAGE = <<<TEXT
Привет! Я Михей, студийный звукорежиссер, аранжировщик и клавишник. Если тебе нужно:

~~Сделать саундтрек/саунд-дизайн к творческому, коммерческому видео или рекламе;

~~Хорошо записать, свести и сделать мастеринг песни (в том числе и концерта); Сделать качественную аудио-редакцию и монтаж (чистка/реставрация/тональная и ритмическая коррекция голосов и инструментов);

~~Написать аранжировку к песне 

~~Консультация по работе в Ableton Live (настройка проектов для студийной записи, лайвов, темплейты для разных задач); 


Ниже представлены некоторые из моих работ по написанию, записи, сведению и мастерингу музыки.
TEXT;


    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $photo = 'https://barsukova-design.ru/mikhey_bot/photo/mikhey.jpg';

        $keyboard = new InlineKeyboard(
            [
                [
                    'text' => 'Мои работы',
                    'callback_data' => 'works'
                ],
            ],
            [
                [
                    'text' => 'Как связаться со мной',
                    'callback_data' => 'contacts'
                ],
            ],
        );
        $this->replyToChat(self::MESSAGE);
        return Request::sendPhoto([
            'chat_id' => $chat_id,
            'photo'   => $photo,
            'reply_markup' => $keyboard
        ]);
    }
}
