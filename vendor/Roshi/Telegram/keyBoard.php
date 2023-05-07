<?php

namespace Bot\Telegram;

class keyBoard
{
    /**
     * Формирование клавиатуры
     * @param array $buttons
     * @return array
     */
    public static function keyboard(array $buttons): array
    {
        $keyboard = [];

        foreach ($buttons as $row => $buttonRow) {
            foreach ($buttonRow as $col => $text) {
                $keyboard[$row][$col]['text'] = $text;
            }
        }

        return array('keyboard' => $keyboard, 'resize_keyboard' => true);
    }

    /**
     * Формирование inline клавитауры
     * @param array $buttons
     * @return array|array[]
     */
    public static function inline(array $buttons): array
    {
        $inline = [
            'inline_keyboard' => []
        ];

        foreach ($buttons as $row => $buttonRow) {
            foreach ($buttonRow as $col => $button) {
                $inline['inline_keyboard'][$row][$col] = [
                    'callback_data' => isset($button['callback_data']) ? $button['callback_data'] : '',
                    'text' => isset($button['text']) ? $button['text'] : ''
                ];
            }
        }

        return $inline;
    }
}