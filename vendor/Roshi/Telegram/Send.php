<?php

namespace Bot\Telegram;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\InputFile;
use Longman\TelegramBot\Entities\ReplyKeyboardRemove;
use Longman\TelegramBot\Exception\TelegramException;

class Send
{
    public static array $messages;
    public static $bot;

    public static function setBot($bot)
    {
        self::$bot = $bot;
    }



    public static function message($text, $keyboard = null, $pathFile = null)
    {
        if ($pathFile == null) {
            if ($keyboard != 'del') {
                Request::sendMessage([
                    'chat_id' => self::$bot->chat_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'reply_markup' => $keyboard,
                ]);
            } else {
                $keyboard = new ReplyKeyboardRemove();
                Request::sendMessage([
                    'chat_id' => self::$bot->chat_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'reply_markup' => $keyboard,
                ]);
            }
        } else {
            if ($keyboard != 'del') {
                $photo = new InputFile($pathFile);
                $result = Request::sendMessage([
                    'chat_id' => self::$bot->chat_id,
                    'photo' => $photo,
                    'caption' => $txt,
                    'reply_markup' => $keyboard,
                ]);
            } else {
                $keyboard = new ReplyKeyboardRemove();
                $photo = new InputFile($pathFile);
                $result = Request::sendMessage([
                    'chat_id' => self::$bot->chat_id,
                    'photo' => $photo,
                    'caption' => $txt,
                    'reply_markup' => $keyboard,
                ]);
            }
        }
    }

    public static function photo($caption, $pathFile)
    {
        $photo = new InputFile($pathFile);
        $result = Request::sendPhoto([
            'chat_id' => self::$bot->chat_id,
            'photo'   => $photo,
            'caption' => $caption,
        ]);
    }

    public static function doc($caption, $pathFile)
    {
        $document = new InputFile($pathFile);
        $result = Request::sendDocument([
            'chat_id'    => self::$bot->chat_id,
            'document'   => $document,
            'caption'    => $caption,
        ]);
    }

    public static function copy($chat_id)
    {
        $result = Request::sendCopy([
            'chat_id'             => $chat_id,
            'from_chat_id'        => self::$bot->chat_id,
            'message_id'          => self::$bot->message_id,
        ]);
    }

    public static function edit($text, $keyboard = null, $pathFile = null)
    {
        if ($keyboard == null && $pathFile == null)
        {
            $result = Request::editMessageText([
                'chat_id'    => self::$bot->chat_id,
                'message_id' => self::$bot->message_id,
                'text'       => $text,
            ]);
        } elseif ($keyboard != null && $pathFile == null)
        {
            $result = Request::editMessageText([
                'chat_id'      => self::$bot->chat_id,
                'message_id'   => self::$bot->message_id,
                'text'         => $text,
                'reply_markup' => $keyboard,
            ]);
        } elseif ($keyboard == null && $pathFile != null)
        {
            $newPhoto = new InputMediaPhoto($pathFile);
            $result = Request::editMessageMedia([
                'chat_id'    => self::$bot->chat_id,
                'message_id' => self::$bot->message_id,
                'media'      => $newPhoto,
                'caption'    => $text,
            ]);
        } elseif ($keyboard != null && $pathFile != null)
        {
            $newPhoto = new InputMediaPhoto($pathFile);
            $result = Request::editMessageMedia([
                'chat_id'    => self::$bot->chat_id,
                'message_id' => self::$bot->message_id,
                'media'      => $newPhoto,
                'caption'    => $text,
            ]);
            $keyboardResult = Request::editMessageReplyMarkup([
                'chat_id'      => self::$bot->chat_id,
                'message_id'   => self::$bot->message_id,
                'reply_markup' => $keyboard,
            ]);
        }
    }




}