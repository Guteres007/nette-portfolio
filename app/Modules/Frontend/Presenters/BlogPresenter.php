<?php


namespace App\Modules\Frontend\Presenters;
use App\Entities\Post;
use Nettrine\ORM\EntityManagerDecorator;
use Tracy\ILogger;

class BlogPresenter extends BasePresenter
{
    /**
     * @inject
     * @var EntityManagerDecorator
     */
    public $entityManager;

    /**
     * @inject
     * @var ILogger
     */
    public $logger;

    public function renderIndex()
    {
        $this->template->posts = $this->entityManager->getRepository(Post::class)->findBy([],['id' => 'desc']);

    }

    public function renderShow($slug)
    {
        $post = $this->entityManager->getRepository(Post::class)->findOneBy(['slug' => $slug]);
        if (!$post) {
            $this->logger->log($slug . ' nenalezen', 'info');
            $this->error('Nenalezeno');
        }
        $this->template->post = $post;
    }
}
