<?php
declare(strict_types=1);

namespace Obzivatel;

use Obzivatel/ObzivatelContract;

class Obzivatel extends TelegramAPI implements ObzivatelContract
{
    private string $token;

    public int $chatID;

    private string $url;

    public function __construct(int $chatID)
    {
        $this->token = config('obzivatel.token');
        $this->chatID = $chatID;
    }

    public function run()
    {
        $message = "Hello World!";

        while (true) {
            $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
            $data = array(
                'chat_id' => $this->chatID,
                'text' => $message,
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            // Wait for 2 hours before sending the next message
            sleep(7200);
        }
    }
}