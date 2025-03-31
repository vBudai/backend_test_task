<?php

namespace App\DTO\Response;

use Symfony\Component\HttpFoundation\Response;

class SuccessResponse implements \JsonSerializable
{
    public function __construct(
        public int $code = Response::HTTP_OK,
        public ?string $message = null,
        public mixed $data = [],
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'data' => $this->data
        ];
    }
}