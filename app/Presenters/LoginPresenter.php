<?php


namespace App\Presenters;


use App\Entities\User;
use App\Secure\Auth;
use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Nette\Application\UI\Presenter;


class LoginPresenter extends Presenter
{
    /**
     * @inject
     * @var Auth
     */
    public $auth;

    /**
     * @inject
     * @var EntityManagerDecorator
     */
    public $entityManager;

    public function renderIndex()
    {
        $oo = $this->entityManager->find(User::class, 1);
        bdump($oo);
    }

    public function actionIndex()
    {
       $this->auth->authenticate('Guteres', '123456');

    }
}
