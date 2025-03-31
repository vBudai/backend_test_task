<?php

namespace App\DTO\Response;

use JsonSerializable;

class ErrorResponse implements JsonSerializable
{
    public function __construct(
        public int $code,
        public string $message,
        public array $details = []
    ) {
    }

    public function jsonSerialize(): array
    {
        $result =  [
            'code' => $this->code,
            'message' => $this->message,
        ];
        if($this->details) {
            $result['details'] = $this->details;
        }

        return $result;
    }
}