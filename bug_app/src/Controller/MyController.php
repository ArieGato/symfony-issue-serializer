<?php

namespace App\Controller;

use MyNamespace\Dto\GenericDto;
use MyNamespace\Dto\MyDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MyController extends AbstractController
{
    #[Route('/bug', name: 'bug')]
    public function index(SerializerInterface $serializer): Response
    {
        $json = '{ "dto": { "id": 1 }}';
        $className = GenericDto::class . '<' . MyDto::class . '>';

        /** @var GenericDto<MyDto> $result */
        $result = $serializer->deserialize($json, $className, 'json');

        $id = $result->dto->id;

        return new Response($id, 200);
    }
}