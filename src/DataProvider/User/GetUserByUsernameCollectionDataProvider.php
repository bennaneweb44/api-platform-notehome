<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider\User;

use App\Entity\User;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

final class GetUserByUsernameCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $currentRequest;
    private $userRepository;

    public function __construct(
        RequestStack $requestStack,
        UserRepository $userRepository
    ) {
        $this->currentRequest = $requestStack->getCurrentRequest();
        $this->userRepository = $userRepository;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return User::class === $resourceClass && $operationName === 'get_by_username';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Incomming attributes from request
        $attributes = $this->currentRequest->attributes;

        // Get username
        $parameters = $attributes->all();
        $username = isset($parameters['username']) && 
                    $parameters['username'] !== '' ? 
                    $parameters['username'] : 
                    '';
        
        $user = $this->userRepository->findOneBy(['username' => $username]);

        if ($user instanceof User) {
            return [
                $user
            ];
        }

        return [];
    }
}