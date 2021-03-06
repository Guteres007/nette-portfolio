<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;


class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);
		$wwwDir = $appDir . '/www';
        //$configurator->setDebugMode(true);
		$configurator->setDebugMode(['178.22.113.33','217.170.104.227' ]); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/local.neon');
        $configurator->addParameters([
            'wwwDir' => $wwwDir
        ]);
		return $configurator;
	}
}
