<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Post;

class BlogController extends Controller
{
    public function actionIndex()
    {
        $posts = Post::find()
            ->where(['status' => 1])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        
        return $this->render('index', [
            'posts' => $posts,
        ]);
    }
    
    public function actionView($slug)
    {
        $post = Post::find()
            ->where(['slug' => $slug, 'status' => 1])
            ->one();
        
        if (!$post) {
            throw new NotFoundHttpException('Article non trouvé.');
        }
        
        // Incrémenter le compteur de vues
        $post->updateCounters(['views' => 1]);
        
        return $this->render('view', [
            'post' => $post,
        ]);
    }
}