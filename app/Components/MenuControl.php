<?php

namespace App\Components;

use Nette\Application\UI\Control;

class MenuControl extends Control
{
    public function render(): void
    {
        $this->template->render(__DIR__ . '/menu.latte');
    }
}
