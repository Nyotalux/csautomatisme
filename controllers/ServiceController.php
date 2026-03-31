<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Service;

class ServiceController extends Controller
{
    public function actionIndex()
    {
        $services = Service::find()
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();
        
        return $this->render('index', [
            'services' => $services,
        ]);
    }
    
    public function actionView($slug)
    {
        $service = Service::find()
            ->where(['slug' => $slug])
            ->with(['sectors', 'gallery'])
            ->one();
        
        if (!$service) {
            throw new NotFoundHttpException('Service non trouvé.');
        }
        
        return $this->render('view', [
            'service' => $service,
        ]);
    }
}