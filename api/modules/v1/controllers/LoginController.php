<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\models\Login;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class LoginController extends Controller
{   

     /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $login = new Login();
        $login->load(Yii::$app->request->post(), '');
        if ( $login->attemptLogin()) {

            return [
                'token' => $login->generateToken(),
            ];
        } 
        elseif (!$login->hasErrors()) {
            throw new ServerErrorHttpException('Failed to login.');
        }
        
        return $login;
        
    }
}


