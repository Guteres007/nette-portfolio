<?php


namespace App\Presenters;


use App\Entities\Label;
use App\Entities\Post;
use Doctrine\ORM\EntityManager;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Http\Request;

class PostPresenter extends BasePresenter
{
    /**
     * @inject
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    public $entityManager;

    /**
     * @inject
     * @var \App\Services\FileUploader
     */
    public $fileUploader;

    private $post;


    public function renderIndex()
    {
       $this->fileUploader->showMessage();
        $this->template->posts = $this->entityManager->getRepository(Post::class)->findAll();
    }

    public function renderEdit($id)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($id);

        if (!$post) {
            return $this->error('A ja jaj');
        }
        $this->getComponent('postForm')
            ->setDefaults([
                'title' => $post->getTitle(),
                'description' => $post->getDescription()
            ]);
    }

    public function actionEdit($id)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($id);
        $this->post = $post;

    }

    public function actionDelete($id)
    {
        $post = $this->entityManager->getRepository(Post::class)->find($id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
        $this->flashMessage('Smazáno', 'success');
        $this->redirect('Post:index');
    }


    //formComponenta

    public function createComponentPostForm(): Form
    {
        $form = new Form();
        $form->addText('title')->addRule($form::LENGTH, 'Musí být vyplněné', [1, 30]);;
        $form->addText('description')->setRequired(true);
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'formOk'];
        return $form;
    }


    public function formOk(Form $form, $data): void
    {
        $post = new Post();
        if ($this->getAction() === 'edit') {
            $post = $this->post;
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setTitle($data->title);
            $post->setDescription($data->description);
            $post->setAuthor('Tonda Omáčka');
            if ($this->getAction() !== 'edit') {
                $label = new Label();
                $label->setText('label text' . random_int(1, 2002));
                $post->addLabel($label);
            }

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }


        $this->flashMessage('Uloženo');
        $this->redirect('Post:index');
    }


}
