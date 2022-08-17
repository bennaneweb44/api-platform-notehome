<?php

namespace App\DataProvider\Note\Item;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Note;
use App\Repository\NoteRepository;

final class GetNoteItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $noteRepository;

    public function __construct(
        NoteRepository $noteRepository,
    ) {
        $this->noteRepository = $noteRepository;
    }
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Note
    {
        $note = $this->noteRepository->findOneBy(['id' => $id]);

        if ($note instanceof Note) {

            // Catégorie
            $stdCatégorie = [];
            $stdCatégorie['nom'] = $note->getCategory()->getNom();
            $stdCatégorie['couleur'] = $note->getCategory()->getCouleur();
            $stdCatégorie['icone'] = $note->getCategory()->getIcone();
            $note->setCategoryArray($stdCatégorie);

            // User
            $stdUser = [];
            $stdUser['username'] = $note->getUser()->getUsername();
            $stdUser['email'] = $note->getUser()->getEmail();
            $stdUser['avatar'] = $note->getUser()->getAvatar();
            $note->setUserArray($stdUser);

            return $note;
        }

        return null;
    }
}