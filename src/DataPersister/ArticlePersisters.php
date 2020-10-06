<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;

class ArticlePersisterss implements DataPersisterInterface
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($data) : bool
    {
        return $data instanceof Articles;
    }

    public function persist($data)
    {
        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        
    }
}