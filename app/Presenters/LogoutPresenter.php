<?php


namespace App\Presenters;


use Nette\Application\UI\Presenter;

class LogoutPresenter extends BasePresenter
{
    public function actionLogout() {
        $this->getUser()->logout();
        $this->redirect('Post:index');
    }
}
