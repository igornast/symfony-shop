<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class BaseRepository
{
    protected ObjectRepository $repository;
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, string $entity)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($entity);
    }
}
