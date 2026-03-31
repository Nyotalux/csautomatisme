<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class SeoComponent extends Component
{
    public $defaultTitle = 'CS Automatisme';
    public $defaultDescription = 'Expert en automatisme, domotique et électricité industrielle. Solutions sur mesure pour vos projets.';
    public $defaultKeywords = 'automatisme, domotique, électricité, robotique, industrie';
    public $defaultAuthor = 'CS Automatisme';
    
    public function setMetaTags($title = null, $description = null, $keywords = null, $author = null, $image = null)
    {
        $view = Yii::$app->view;
        
        // Titre
        $view->title = $title ? $title . ' | ' . $this->defaultTitle : $this->defaultTitle;
        
        // Meta description
        $metaDescription = $description ?: $this->defaultDescription;
        $view->registerMetaTag(['name' => 'description', 'content' => $metaDescription]);
        
        // Meta keywords
        $metaKeywords = $keywords ?: $this->defaultKeywords;
        $view->registerMetaTag(['name' => 'keywords', 'content' => $metaKeywords]);
        
        // Meta author
        $view->registerMetaTag(['name' => 'author', 'content' => $author ?: $this->defaultAuthor]);
        
        // Open Graph tags pour les réseaux sociaux
        $view->registerMetaTag(['property' => 'og:title', 'content' => $view->title]);
        $view->registerMetaTag(['property' => 'og:description', 'content' => $metaDescription]);
        $view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
        $view->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->request->absoluteUrl]);
        
        if ($image) {
            $view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->hostInfo . $image]);
        }
        
        // Twitter Card
        $view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
        $view->registerMetaTag(['name' => 'twitter:title', 'content' => $view->title]);
        $view->registerMetaTag(['name' => 'twitter:description', 'content' => $metaDescription]);
        
        if ($image) {
            $view->registerMetaTag(['name' => 'twitter:image', 'content' => Yii::$app->request->hostInfo . $image]);
        }
    }
    
    public function generateSitemap()
    {
        $urls = [];
        
        // Page d'accueil
        $urls[] = [
            'loc' => Yii::$app->urlManager->createAbsoluteUrl(['site/index']),
            'changefreq' => 'daily',
            'priority' => 1.0,
        ];
        
        // Services
        $services = \app\models\Service::find()->all();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => Yii::$app->urlManager->createAbsoluteUrl(['service/view', 'slug' => $service->slug]),
                'changefreq' => 'weekly',
                'priority' => 0.8,
            ];
        }
        
        // Secteurs
        $sectors = \app\models\Sector::find()->all();
        foreach ($sectors as $sector) {
            $urls[] = [
                'loc' => Yii::$app->urlManager->createAbsoluteUrl(['sector/view', 'slug' => $sector->slug]),
                'changefreq' => 'weekly',
                'priority' => 0.7,
            ];
        }
        
        // Pages statiques
        $pages = ['about', 'contact'];
        foreach ($pages as $page) {
            $urls[] = [
                'loc' => Yii::$app->urlManager->createAbsoluteUrl(['site/' . $page]),
                'changefreq' => 'monthly',
                'priority' => 0.5,
            ];
        }
        
        return $urls;
    }
}