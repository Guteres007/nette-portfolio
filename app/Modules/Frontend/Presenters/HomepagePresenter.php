<?php


namespace App\Modules\Frontend\Presenters;

use Nette;


final class HomepagePresenter extends BasePresenter
{
    protected $database;
    public function __construct(Nette\Database\Explorer $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    public function renderDefault() {

    }
}
