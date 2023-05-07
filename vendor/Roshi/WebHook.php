<?php

namespace Bot;

class WebHook
{

    public static function setWebHook(): bool
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        {
        return self::checkWebHook();
        } else {
            return false;
        }

    }

    private static function checkWebHook(): bool
    {
        $url = "https://api.telegram.org/bot".$_ENV['BOT_TOKEN']."/getWebhookInfo";
        $result = json_decode(file_get_contents($url), true);
        if ($result['ok'] && $result['result']['url'] !== null)
            if ($result['result']['url'] == $_ENV['URL_BOT'].'/Bot/bot.php') {
                return true;
            } else {
                return self::set();
            }
        else
            return self::set();

    }

    private static function set(): bool
    {
        $postData = [
            'url' => $_ENV['URL_BOT']."/Bot/bot.php"
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$_ENV['BOT_TOKEN']."/setWebhook");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec($ch);
        curl_close($ch);

        return self::checkWebHook();

    }
}