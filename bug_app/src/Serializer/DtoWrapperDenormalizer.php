<?php

namespace App\Serializer;

use MyNamespace\Dto\GenericDto;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;


class DtoWrapperDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    private string $genericDtoRegex;

    public function __construct()
    {
        $this->genericDtoRegex = "/^" . str_replace("\\", "\\\\", GenericDto::class) . "<(.*)>$/";
    }

    /** {@inheritDoc} */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        preg_match($this->genericDtoRegex, $type, $matches);

        $data['dto'] = $this->denormalizer->denormalize($data['dto'], $matches[1], $format, $context);

        return $this->denormalizer->denormalize($data, GenericDto::class, $format, $context);
    }

    /** {@inheritDoc} */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        $isMatch = preg_match($this->genericDtoRegex, $type);

        return $isMatch > 0;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['object' => null, '*' => false];
    }
}