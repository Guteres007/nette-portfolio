<?php


namespace App\Modules\Admin\Presenters;


use Nette\Application\UI\Presenter;

class LogoutPresenter extends AdminPresenter
{
    public function actionLogout() {
        $this->getUser()->logout();
        $this->redirect(':Frontend:Homepage:default');
    }
}
