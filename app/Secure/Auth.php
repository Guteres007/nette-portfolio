<?php


namespace App\Secure;

use App\Entities\User;
use Nette;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;
use Nettrine\ORM\EntityManagerDecorator;

class Auth implements Nette\Security\Authenticator
{
    private $passwords;
    private $em;

    public function __construct(
        Nette\Security\Passwords $passwords,
        EntityManagerDecorator $em
    ) {
        $this->em = $em;
        $this->passwords = $passwords;
    }

    function authenticate(string $username, string $password): IIdentity
    {

        $row = $this->em->getRepository(User::class)->findOneBy(['username' => $username]);

        if (!$row) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->getPassword())) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $row->getId(),
            $row->getRole(), // nebo pole více rolí
            ['name' => $row->getUsername()]
        );
    }


}
