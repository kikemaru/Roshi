<?php

namespace Bot;

class Start
{
    public $data;

    /* cвойства полученные из конструктора*/
    public $chat_id;
    public $user_id;
    public $type;
    public $text;
    public $user_name;
    public $message_id;

    /* cвойства полученные из конструктора*/


    public $request;

    /**
     * @param $data
     */
    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->data = $data;
            $this->distribution($data);
            $this->request = $data;
        }
    }

    /**
     * @param $data
     * @return void
     */
    private function distribution($data = null)
    {
        if (isset($data)) {
            $arr = json_decode($data, true);
            if (isset($arr['callback_query'])) {
                $this->type = 'callback';
                $this->text = $arr['callback_query']['data'];
                $this->chat_id = $arr['callback_query']['message']['chat']['id'];
                $this->user_id = $arr['callback_query']['message']['from']['id'];
                $this->message_id = $arr['callback_query']['message']['message_id'];
                $this->user_name = $arr['callback_query']['message']['from']['first_name'];
            } else {
                $this->type = 'message';
                $this->text = $arr['message']['text'];
                $this->chat_id = $arr['message']['chat']['id'];
                $this->user_id = $arr['message']['from']['id'];
                $this->user_name = $arr['message']['from']['first_name'];
                $this->message_id = $arr['message']['message_id'];
            }
        }
    }

    public function getRequestFull()
    {
        return json_encode($this->request);
    }
}