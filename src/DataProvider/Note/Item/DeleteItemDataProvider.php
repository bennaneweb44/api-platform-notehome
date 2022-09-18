<?php

namespace App\DataProvider\Note\Item;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Service\UserService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ShareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

final class DeleteItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $entityManager;   
    private $noteRepository;
    private $shareRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        NoteRepository $noteRepository,
        ShareRepository $shareRepository
    ) {
        $this->entityManager = $entityManager;
        $this->noteRepository = $noteRepository;
        $this->shareRepository = $shareRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'delete';
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): string
    {
        // Note
        $note = $this->noteRepository->findOneBy([
            'id' => $id
        ]);

        // Remove his shares
        $shares = $this->shareRepository->findBy([
            'note' => $note
        ]);
        foreach($shares as $share) {
            $this->entityManager->remove($share);
        }

        // Remove note
        $this->entityManager->remove($note);

        // Flush
        $this->entityManager->flush();

        // Response
        return Response::HTTP_NO_CONTENT;
    }
}