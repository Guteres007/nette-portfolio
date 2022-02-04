<?php


namespace App\Presenters;


use App\Entities\Post;
use Doctrine\ORM\EntityManager;
use Nette\Application\UI\Presenter;

class PostPresenter extends \Nette\Application\UI\Presenter
{
    private $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        Presenter::__construct();
        $this->entityManager = $entityManager;
    }

    public function renderShow( )
    {
      $this->entityManager->find(Post::class,1);

    }

}
