<?php

namespace App\DataPersister;

use App\Entity\Element;
use App\Repository\ShareRepository;
use App\Service\UserService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ElementDataPersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof Element;
    }

    public function persist($data, array $context = [])
    {
        $currentUser = $this->userService->getCurrentUser();

        // Note
        $note = $data->getNote();

        // Shares
        $shares = $this->shareRepository->findBy(['note' => $note]);

        $now = new DateTimeImmutable('now');

        foreach($shares as $share) {
            $share->setUpdatedAt($now);
            $share->setSeen(false);
            $share->setUpdatedBy($currentUser);
            $this->entityManager->persist($share);
        }

        // Element
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        
        return $data;
    }

    public function remove($data, array $context = [])
    {
        // Remove Element
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}