<?php

namespace App\DataPersister;

use App\Entity\Note;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;

final class NoteDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Note;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        
        return $data;
    }

    public function remove($data, array $context = [])
    {
        // Remove his elements
        foreach($data->getElements() as $elem) {
            $this->entityManager->remove($elem);        
        }
        
        // Remove Note
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}