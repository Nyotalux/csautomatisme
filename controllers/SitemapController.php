<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $urls = Yii::$app->seo->generateSitemap();
        
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_XML;
        $response->headers->set('Content-Type', 'application/xml');
        
        return $this->renderPartial('index', [
            'urls' => $urls,
        ]);
    }
}