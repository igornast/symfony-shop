<?php
declare(strict_types=1);

namespace App\Api\Application\Serializer;


interface AppSerializerInterface
{
    public function deserialize(string $data, string $outputClass);

    public function normalize($data, array $context = []);
}