<?php


namespace App\Modules\Admin\Presenters;


use App\Modules\Frontend\Entities\Label;
use App\Modules\Frontend\Entities\Post;
use Nette\Application\UI\Form;
use Nette\Neon\Neon;


class PostPresenter extends AdminPresenter
{
    /**
     * @inject
     * @var \Nettrine\ORM\EntityManagerDecorator
     */
    public $entityManager;

    /**
     * @inject
     * @var \App\Modules\Frontend\Services\FileUploader
     */
    public $fileUploader;

    private $post;

    private $uploadDir;

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function renderIndex()
    {
        $this->template->posts = $this->entityManager->getRepository(Post::class)->findBy([], ['id' => 'desc']);
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
        $this->post = $this->entityManager->getRepository(Post::class)->find($id);


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
        $form->addTextArea('description')->setRequired(true);
        $form->addUpload('image');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'formOk'];
        return $form;
    }


    public function formOk(Form $form, $data): void
    {

        $image = $data->image;
        $imageName = $this->uploadDir ."/". random_int(999, 99999) . $image->getSanitizedName();
        $image->move($imageName);

        $post = new Post();
        if ($this->getAction() === 'edit') {
            $post = $this->post;
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setTitle($data->title);
            $post->setDescription($data->description);
            $post->setImageName($imageName);
            $post->setAuthor('Martin Andráši');
            if ($this->getAction() !== 'edit') {
                $label = new Label();
                $label->setText('label text' . random_int(1, 2002));
                $post->addLabel($label);
            }

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }


        $this->flashMessage('Uloženo', 'success');
        $this->redirect('Post:index');
    }


}
