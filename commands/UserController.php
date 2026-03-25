<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class UserController extends Controller
{
    public function actionCreate($username, $password)
    {
        $user = new User();
        $user->username = $username;
        // On utilise 'password' car c'est le nom de votre colonne
        $user->password = \Yii::$app->security->generatePasswordHash($password);
        $user->authKey = \Yii::$app->security->generateRandomString();
        $user->accessToken = \Yii::$app->security->generateRandomString();



        if ($user->save()) {
            echo "User '{$username}' created successfully.\n";
        } else {
            echo "Failed to create user:\n";
            print_r($user->errors);
        }
    }
}