<?php

namespace MyNamespace\Dto;

/**
 * @template T of DtoBase
  */
class GenericDto extends GenericDtoBase
{
    /**
     * @var T
     */
    public mixed $dto = null;
}