<?php


namespace App\Presenters;

use App\Components\MenuControl;
use Nette;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function createComponentMenu()
    {
       return new MenuControl();
    }
}
