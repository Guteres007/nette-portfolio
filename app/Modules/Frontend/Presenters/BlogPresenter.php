<?php


namespace App\Modules\Frontend\Presenters;
use App\Entities\Post;
use Nettrine\ORM\EntityManagerDecorator;

class BlogPresenter extends BasePresenter
{
    /**
     * @inject
     * @var EntityManagerDecorator
     */
    public $entityManager;


    public function renderIndex()
    {
        $this->template->posts = $this->entityManager->getRepository(Post::class)->findBy([],['id' => 'desc']);

    }

    public function renderShow($slug)
    {
        $this->template->post = $this->entityManager->getRepository(Post::class)->findOneBy(['slug' => $slug]);
    }
}
