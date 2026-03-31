<?php

namespace app\modules\extranet;

/**
 * extranet module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\extranet\controllers';

    /**
     * {@inheritdoc}
     */
public function init()
{
    parent::init();
    
    // Configurer le layout
    \Yii::$app->layoutPath = '@app/modules/extranet/views/layouts';
    \Yii::$app->layout = 'main';
}
}
