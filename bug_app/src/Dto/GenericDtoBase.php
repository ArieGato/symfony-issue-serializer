<?php

namespace MyNamespace\Dto;

use DateTimeImmutable;

class GenericDtoBase
{
    /**
     * @var ?string
     */
    public ?string $destinationAddress = null;

    /**
     * @var ?string
     */
    public ?string $sourceAddress = null;

    /**
     * @var string[]
     */
    public array $messageType = [];

    /**
     * @var ?string
     */
    public ?string $correlationId = null;

    /**
     * @var DateTimeImmutable
     */
    public DateTimeImmutable $sentTime;

    /**
     * @var string
     */
    public string $messageId;
}