<?php

namespace App\DataProvider\Note\Collection;

use App\Entity\Note;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\NoteRepository;

final class GetNotesByRelationsCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $noteRepository;

    public function __construct(
        NoteRepository $noteRepository,
    ) {
        $this->noteRepository = $noteRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Note::class === $resourceClass && $operationName === 'get';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $notes = $this->noteRepository->findAll();
        foreach($notes as $note) {
            
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
        }

        return $notes;
    }
}