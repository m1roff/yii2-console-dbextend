<?php

namespace mirkhamidov;

use yii\base\BootstrapInterface;

class DbexBootstrapClass implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap[$this->id] = [
                'class'  => 'mirkhamidov\console\controllers\DbexController',
                'module' => $this,
            ];
            // $app->controllerNamespace = 'mirkhamidov\console\controllers';
        }
    }
}