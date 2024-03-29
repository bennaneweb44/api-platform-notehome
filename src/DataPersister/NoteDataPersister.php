<?php

namespace App\DataPersister;

use App\Entity\Note;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Repository\ShareRepository;
use App\Service\UserService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class NoteDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ShareRepository
     */
    private $shareRepository;

    /**
     * @var Userservice
     */
    private $userService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        ShareRepository $shareRepository,
        UserService $userService
    ) {
        $this->entityManager = $entityManager;
        $this->shareRepository = $shareRepository;
        $this->userService = $userService;
    }
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Note;
    }

    public function persist($data, array $context = [])
    {
        $currentUser = $this->userService->getCurrentUser();

        // Shares : si user_1 modifie la note, celle-ci doit passer en "non vue" pour l'autre user_2_
        $shares = $this->shareRepository->findBy(['note' => $data]);
        $now = new DateTimeImmutable('now');

        foreach($shares as $share) {
            $share->setUpdatedAt($now);
            $share->setSeen(false);
            $share->setUpdatedBy($currentUser);
            $this->entityManager->persist($share);
        }

        // Note
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