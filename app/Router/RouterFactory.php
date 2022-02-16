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
        $router->addRoute('reference', 'Frontend:Testimonial:index');
        $router->addRoute('blog', 'Frontend:Blog:index');
        $router->addRoute('blog/<slug>', 'Frontend:Blog:show');
        $router->addRoute('/video', 'Frontend:Video:index');
        $router->withModule('Admin')
            ->addRoute('admin/<presenter>/<action>');

		$router->addRoute('', 'Frontend:Homepage:default');


		return $router;
	}
}
