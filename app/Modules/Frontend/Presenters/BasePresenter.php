<?php


namespace App\Modules\Frontend\Presenters;

use App\Modules\Frontend\Components\MenuControl;
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
