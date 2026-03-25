<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class UserController extends Controller
{
    /**
     * Creates a new user.
     * @param string $username
     * @param string $password
     */
    public function actionCreate($username, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = 10; // active
        if ($user->save()) {
            echo "User '{$username}' created successfully.\n";
        } else {
            echo "Failed to create user:\n";
            print_r($user->errors);
        }
    }
}