<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->addRoute('login', 'Frontend:Login:index');
        $router->withModule('Admin')
            ->addRoute('admin/<presenter>/<action>');

		$router->addRoute('', 'Frontend:Homepage:default');


		return $router;
	}
}
