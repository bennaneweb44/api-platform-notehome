<?php

namespace App\DataProvider\Share\Collection;

use App\Entity\Note;
use App\Entity\Share;
use App\Repository\ShareRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\NoteRepository;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetSharesOfNoteCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $shareRepository;
    private $noteRepository;
    private $userService;


    public function __construct(
        RequestStack $requestStack,
        ShareRepository $shareRepository,
        NoteRepository $noteRepository,
        UserService $userService
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->shareRepository = $shareRepository;
        $this->noteRepository = $noteRepository;
        $this->userService = $userService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Share::class === $resourceClass && $operationName === 'get_shares_of_note';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Note
        $parameters = $attributes->all();
        $noteId = isset($parameters['id']) && 
                    is_numeric($parameters['id']) &&
                    $parameters['id'] > 0 ?
                    $parameters['id'] :
                    0;

        $note = $this->noteRepository->findOneBy([
            'id' => $noteId
        ]);

        // User
        $user = $this->userService->getCurrentUser();

        // Shares
        if ($note instanceof Note) {
            $shares = $this->shareRepository->findBy([
                'user_1' => $user,
                'note' => $note
            ]);

            return $shares;
        }

        return [];
    }
}