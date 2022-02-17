<?php


namespace App\Modules\Frontend\Presenters;

use App\Modules\Frontend\Components\MenuControl;
use App\Modules\Frontend\Services\AssetCacheCleaner;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    /**
     * @inject AssetCacheCleaner;
     * @var AssetCacheCleaner
     */
    public $assetCacheCleaner;
    public function __construct()
    {

    }

    protected function createComponentMenu()
    {
       return new MenuControl();
    }

    protected function beforeRender()
    {

        $this->template->jsVersion = $this->assetCacheCleaner->getFileVersion('css/index.js');
        $this->template->cssVersion = $this->assetCacheCleaner->getFileVersion('css/index.css');
    }
}
