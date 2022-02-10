<?php


namespace App\Presenters;


use App\Entities\User;
use App\Secure\Auth;
use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;


class LoginPresenter extends BasePresenter
{
    /**
     * @inject
     * @var Auth
     */
    public $auth;


    public function createComponentLoginForm() : Form
    {
        $form = new Form();
        $form->addText('username');
        $form->addPassword('password');
        $form->onSuccess[] = [$this, 'formOk'];
        return $form;
    }

    public function formOk(Form $form, $data )
    {

        $this->auth->authenticate($data->username, $data->password);
        $this->getUser()->login($data->username, $data->password);
        //'Guteres', '123456'
        $this->flashMessage('Přihlášen', 'success');
        $this->redirect('Admin:Post:index');

    }
}
