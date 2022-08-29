<?php

namespace App\DataProvider\Note\Item;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Service\UserService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

final class NoteItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $noteRepository;
    private $userService;

    public function __construct(
        NoteRepository $noteRepository,
        UserService $userService
    ) {
        $this->noteRepository = $noteRepository;
        $this->userService = $userService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get';
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Note
    {
        // Note
        $note = $this->noteRepository->findOneBy([
            'id' => $id
        ]);
        
        // User
        $user = $this->userService->getCurrentUser();

        // Update shares
        $shares = $this->shareRepository->findNotSeenUpdates($user, $note);

        foreach($shares as $share) {
            $share->setSeen(true);
            $this->entityManager->persist($share);
        }

        $this->entityManager->flush();

        return $note;
    }
}