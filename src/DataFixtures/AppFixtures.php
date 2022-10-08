<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Element;
use App\Entity\Note;
use App\Entity\Rayon;
use App\Entity\Share;
use App\Entity\User;
use App\Tools\Constants;
use DateTimeImmutable;
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

        $users = $this->loadUsers();
        $categories = $this->loadCategories();
        $notes = $this->loadNotes($users, $categories);
        $rayons = $this->loadRayons($notes);
        $this->loadElements($notes, $rayons);
        $this->loadShares($users, $notes);
    }

    private function loadUsers(): array
    {
        $output = [];

        $admin = new User();
        $admin->setUsername($this->adminUsername);
        $admin->setEmail($this->adminEmail);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setAvatar($this->adminAvatar);
        // Password
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $this->adminPassword);
        $admin->setPassword($hashedPassword);
        $this->manager->persist($admin);
        $output[] = $admin;

        $user = new User();
        $user->setUsername('Jeanne');
        $user->setEmail('jeanne.orhon@yahoo.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setAvatar('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSBGjSeYimOBFkTRv3VK3T8aZZ8a1GWsSFzA&usqp=CAU');
        // Password
        $hashedPassword = $this->passwordHasher->hashPassword($user, $this->adminPassword);
        $user->setPassword($hashedPassword);
        $this->manager->persist($user);
        $output[] = $user;

        $this->manager->flush();

        return $output;
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

    private function loadNotes(array $users, array $categories): array
    {
        $output = [];

        foreach($users as $user) {
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
        }
        
        $this->manager->flush();
        return $output;
    }

    private function loadRayons(array $notes)
    {
        $output = [];
        foreach($notes as $note) {
            if (1 === $note->getType()) {
                foreach(Constants::RAYONS_DEFAULT as $ray) {
                    $rayon = new Rayon();
                    $rayon->setNom($ray['nom']);
                    $rayon->setNote($note);

                    $output[] = $rayon;
                    $this->manager->persist($rayon);
                }
            }
        }

        $this->manager->flush();

        return $output;
    }

    private function loadElements(array $notes, array $rayons): void
    {
        foreach($notes as $note) {
            if (1 === $note->getType()) {
                for($i = 1; $i <= 50; $i++) {
                    $element = new Element();
                    $element->setNom('Element : ' . $i);
                    rand(1, 100) > $i ? $element->setPhoto(null) : $element->setPhoto('https://fr.openfoodfacts.org/images/products/356/470/055/5347/front_fr.37.full.jpg');
                    $element->setNote($note);
                    $rayonKey = rand(0, count(Constants::RAYONS_DEFAULT) -1);
                    $element->setRayon($rayons[$rayonKey]);
                    $element->setBarre(false);

                    $this->manager->persist($element);
                }
                
            }
        }

        $this->manager->flush();
    }

    private function loadShares(array $users, array $notes): void
    {
        $now = new DateTimeImmutable('now');
        $four = 0;
        foreach($notes as $note) {
            if ($four <= 3) {
                $share = new Share();
                $share->setUser1($users[0]);
                $share->setUser2($users[1]);
                $share->setNote($note);
                $share->setSeen(false);
                $share->setUpdatedAt($now);
                
                if ($note->getId() % 2 == 0) {
                    $share->setUpdatedBy($users[0]);
                } else {
                    $share->setUpdatedBy($users[1]);
                }

                $this->manager->persist($share);
            }
            $four++;
        }

        $this->manager->flush();
    }
}
