<?php


namespace App\Modules\Frontend\Presenters;


use App\Modules\Admin\Secure\Auth;
use Nette\Application\UI\Form;


class LoginPresenter extends BasePresenter
{

    /**
     * @inject
     * @var Auth
     */
    public $auth;


    protected function startup()
    {
        parent::startup();
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect(':Admin:Dashboard:index');
        }
    }



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
        $this->redirect(':Admin:Dashboard:index');

    }
}
