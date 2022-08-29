<?php

namespace App\DataProvider\Share\Collection;

use App\Entity\User;
use App\Entity\Share;
use App\Repository\ShareRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetUpdatedSharesCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $shareRepository;
    private $userRepository;


    public function __construct(
        RequestStack $requestStack,
        ShareRepository $shareRepository,
        UserRepository $userRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->shareRepository = $shareRepository;
        $this->userRepository = $userRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Share::class === $resourceClass && $operationName === 'get_updated_shares_of_user';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // User
        $parameters = $attributes->all();
        $userId = isset($parameters['id']) && 
                    is_numeric($parameters['id']) &&
                    $parameters['id'] > 0 ?
                    $parameters['id'] :
                    0;

        $user = $this->userRepository->findOneBy(['id' => $userId]);

        // Shares
        if ($user instanceof User) {
            $shares = $this->shareRepository->findNotSeenUpdates($user);

            return $shares;
        }

        return [];
    }
}