<?php

namespace App\Services;

class MessageService
{
    public function createMessage(array $messages): void
    {
        $messageID = session("message_id", 0) + 1;

        session([
            "messages" => [$messages],
            "message_id" => $messageID
        ]);
    }
}
