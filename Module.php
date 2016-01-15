<?php

namespace mirkhamidov\dbex;

use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'mirkhamidov\dbex\console\controllers';

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class'  => 'mirkhamidov\dbex\console\controllers\DbexController',
                'module' => $this,
            ];
        }
    }
}