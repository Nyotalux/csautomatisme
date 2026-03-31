<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Sector;

class SectorController extends Controller
{
    public function actionIndex()
    {
        $sectors = Sector::find()
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();
        
        return $this->render('index', [
            'sectors' => $sectors,
        ]);
    }
    
    public function actionView($slug)
    {
        $sector = Sector::find()
            ->where(['slug' => $slug])
            ->with(['service', 'gallery'])
            ->one();
        
        if (!$sector) {
            throw new NotFoundHttpException('Secteur non trouvé.');
        }
        
        return $this->render('view', [
            'sector' => $sector,
        ]);
    }
}