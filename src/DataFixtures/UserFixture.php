<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;
    private $arrUsers;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->arrUsers = [
            [
                'email' => 'lam3allam@bennaneweb.fr',
                'username' => 'lam3allam',
                'password' => 'password',
                'role' => 'ROLE_USER'
            ],
            [
                'email' => 'admin@bennaneweb.fr',
                'username' => 'admin',
                'password' => 'password',
                'role' => 'ROLE_ADMIN'
            ],
        ];
    }

    public function load(ObjectManager $manager)
    {
        foreach($this->arrUsers as $userArray) {
            $user = $this->addUserRecord($userArray);
            if ($user instanceof User) {
                $manager->persist($user);
                $manager->flush();
            }        
        }
    }

    private function addUserRecord($userArray)
    {
        $retour = new User();

        $retour->setEmail($userArray['email']);        
        $retour->setRoles([
            $userArray['role']
        ]);
        $retour->setPassword($this->passwordEncoder->encodePassword(
            $retour,
            $userArray['password']
        ));
        $retour->setUsername($userArray['username']);

        return $retour;
    }
}