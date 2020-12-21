<?php

namespace App\Http\Response;

use Illuminate\Support\MessageBag;

trait RespondTrait
{
    public function respondErrors(MessageBag $messageBag): \RuntimeException
    {
        $messageResponse = '';
        foreach ($messageBag->all() as $message) {
            $messageResponse .= $message;
        }

        return new \RuntimeException($messageResponse);
    }

    public function respondError(string $message): \RuntimeException
    {
        return new \RuntimeException($message);
    }
}
