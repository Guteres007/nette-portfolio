<?php


namespace App\Presenters;


use App\Entities\Label;
use App\Entities\Post;
use Doctrine\ORM\EntityManager;
use Nette\Application\UI\Form;
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
      $this->template->posts = $this->entityManager->getRepository(Post::class)->findAll();
    }

    public function renderCreate() {

    }

    //formComponenta

      public function createComponentPostForm(): Form
      {
          $form = new Form();
          $form->addText('title');
          $form->addText('description');
          $form->addSubmit('send', 'Odeslat');
          $form->onSuccess[] = [$this, 'formOk'];
          return $form;
      }


    public function formOk(Form $form, $data): void
    {
        $post = new Post();
        $post->setTitle($data->title);
        $post->setDescription($data->description);
        $post->setAuthor('Tonda Omáčka');
        $label = new Label();
        $label->setText('label text'. random_int(1, 2002));
        $post->addLabel($label);
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        $this->flashMessage('Uloženo.');
        $this->redirect('Post:show');
    }


}
