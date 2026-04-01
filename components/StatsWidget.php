<?php
namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Post;
use app\models\Service;

class StatsWidget extends Widget
{
    public function run()
    {
        $totalServices = Service::find()->count();
        $totalArticles = Post::find()->where(['status' => 1])->count();
        
        // Spécifier le chemin complet vers la vue
        return $this->render('@app/views/widgets/stats', [
            'totalServices' => $totalServices,
            'totalArticles' => $totalArticles,
        ]);
    }
}