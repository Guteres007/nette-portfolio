<?php


namespace App\Presenters;


use App\Entities\Post;
use Doctrine\ORM\EntityManager;
use Nette\Application\UI\Presenter;

class PostPresenter extends \Nette\Application\UI\Presenter
{
    /**
     * @inject
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    public $entityManager;


    public function renderShow( )
    {
      dump($this->entityManager->getRepository(Post::class)->findAll());

    }

}
