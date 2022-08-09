<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use App\Tools\Constants;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // Sensitive data from env
    protected $adminUsername;
    protected $adminPassword;
    protected $adminEmail;
    protected $adminAvatar;
    protected $passwordHasher;

    // Manager
    protected $manager;
    
    public function __construct(
        string $adminUsername,
        string $adminPassword, 
        string $adminEmail,
        string $adminAvatar,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->adminUsername = $adminUsername;
        $this->adminPassword = $adminPassword;
        $this->adminEmail = $adminEmail;
        $this->adminAvatar = $adminAvatar;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadUsers();
        $this->loadCategories();
    }

    private function loadUsers(): void
    {
        $admin = new User();
        $admin->setUsername($this->adminUsername);
        $admin->setEmail($this->adminEmail);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setAvatar($this->adminAvatar);
        // Password
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $this->adminPassword);
        $admin->setPassword($hashedPassword);        

        $this->manager->persist($admin);
        $this->manager->flush();
    }

    private function loadCategories(): void
    {
        foreach(Constants::CATEGORIES_DEFAULT as $cat) {
            $category = new Category();
            $category->setNom($cat['nom']);
            $category->setCouleur($cat['couleur']);
            $category->setIcone($cat['icone']);
            $this->manager->persist($category);
        }

        $this->manager->flush();
    }
}
