<?php

namespace App\DataProvider\Note\Item;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Service\UserService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ShareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pusher\Pusher;

final class NoteItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $entityManager;   
    private $noteRepository;
    private $userService;
    private $shareRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        NoteRepository $noteRepository,
        UserService $userService,
        ShareRepository $shareRepository
    ) {
        $this->entityManager = $entityManager;
        $this->noteRepository = $noteRepository;
        $this->userService = $userService;
        $this->shareRepository = $shareRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get';
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Note
    {
        // Send notification
        $pusher = new Pusher("ca4f0d23201d79ed29c6", "08ca920174c3fd6eefee", "1499804", array('cluster' => 'eu'));

        $pusher->trigger('pusher', 'note-done', array('message' => 'hello world'));

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