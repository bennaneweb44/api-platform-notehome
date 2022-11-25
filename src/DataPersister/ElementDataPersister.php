<?php

namespace App\DataPersister;

use App\Entity\Element;
use App\Repository\ShareRepository;
use App\Service\UserService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Repository\ElementRepository;
use Symfony\Component\HttpFoundation\Response;

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
     * @var ElementRepository
     */
    private $elementRepository;

    /**
     * @var Userservice
     */
    private $userService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        ShareRepository $shareRepository,
        ElementRepository $elementRepository,
        UserService $userService
    ) {
        $this->entityManager = $entityManager;
        $this->shareRepository = $shareRepository;
        $this->elementRepository = $elementRepository;
        $this->userService = $userService;
    }
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Element;
    }

    public function persist($data, array $context = [])
    {
        if ('post' === $context['item_operation_name']) {
            $elementExist = $this->elementRepository->findOneBy([
                'nom' => $data->getNom(),
                'note' => $data->getNote(),
                'rayon' => $data->getRayon()
            ]);
    
            if ($elementExist instanceof Element) {
                return new Response('Element already exist', Response::HTTP_BAD_REQUEST);
            }
        }

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