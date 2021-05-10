<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class CreateUsers extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('qwe@mail.ru');
        $password = $this->encoder->encodePassword($user, 'qwe123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);
        $user->setUsername('qwe');

        $admin =new User();
        $admin->setEmail('qwert@mail.ru');
        $password = $this->encoder->encodePassword($user, 'qwe123');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('qwert');

        $manager->persist($admin);
        $manager->persist($user);
        $manager->flush();
    }
}
