<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Element;
use App\Entity\Note;
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

        $user = $this->loadUsers();
        $categories = $this->loadCategories();
        $notes = $this->loadNotes($user, $categories);
        $this->loadElements($notes);
    }

    private function loadUsers(): User
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

        return $admin;
    }

    private function loadCategories(): array
    {
        $output = [];
        foreach(Constants::CATEGORIES_DEFAULT as $cat) {
            $category = new Category();
            $category->setNom($cat['nom']);
            $category->setCouleur($cat['couleur']);
            $category->setIcone($cat['icone']);

            $output[] = $category;
            $this->manager->persist($category);
        }

        $this->manager->flush();

        return $output;        
    }

    private function loadNotes(User $user, array $categories): array
    {
        $output = [];
        foreach(Constants::NOTES_DEFAULT as $item) {
            $note = new Note();
            $note->setTitle($item['title']);
            $note->setContent($item['content']);
            $note->setType($item['type']);
            $note->setUser($user);
            $note->setCategory($categories[$item['category_indice']]);

            $output[] = $note;
            $this->manager->persist($note);
        }
        
        $this->manager->flush();
        return $output;
    }

    private function loadElements(array $notes): void
    {
        foreach($notes as $note) {
            if ($note->getType() === 1) {
                for($i = 1; $i <= 50; $i++) {
                    $element = new Element();
                    $element->setNom('Element : ' . $i);
                    rand(1, 100) > $i ? $element->setPhoto(null) : $element->setPhoto('https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg');
                    $element->setNote($note);

                    $this->manager->persist($element);
                }
            }
        }

        $this->manager->flush();
    }
}
