<?php


namespace App\Modules\Admin\Presenters;


class AdminPresenter extends \Nette\Application\UI\Presenter
{
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            $this->error('Nemáš oprávnění debile ', 403);
        }
    }
}
