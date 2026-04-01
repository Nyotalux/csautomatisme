<?php

namespace app\modules\extranet\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', ['users' => $users]);
    }
    
    public function actionProfile()
    {
        $user = Yii::$app->user->identity;
        return $this->render('profile', ['user' => $user]);
    }
    
    public function actionView($id)
    {
        $user = User::findOne($id);
        return $this->render('view', ['user' => $user]);
    }
}