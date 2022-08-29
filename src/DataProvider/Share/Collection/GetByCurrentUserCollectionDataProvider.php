<?php

namespace App\DataProvider\Share\Collection;

use App\Entity\Share;
use App\Entity\User;
use App\Repository\ShareRepository;
use App\Repository\NoteRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetByCurrentUserCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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
        return Share::class === $resourceClass && $operationName === 'get';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $currentUser = $this->userService->getCurrentUser();

        // Shares
        if ($currentUser instanceof User) {
            $shares = $this->shareRepository->findBy([
                'user_2' => $currentUser
            ]);

            return $shares;
        }

        return [];
    }
}