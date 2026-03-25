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
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->status = 10;
        $user->created_at = time();
        $user->updated_at = time();
        if ($user->save()) {
            echo "User '{$username}' created successfully.\n";
        } else {
            echo "Failed to create user:\n";
            print_r($user->errors);
        }
    }
}