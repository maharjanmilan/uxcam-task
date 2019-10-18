<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\RegisterUser;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

class RegisterController extends Controller
{   
    
    public function actionRegister()
    {
        
        $newUser = new RegisterUser();

        $newUser->load(\Yii::$app->request->post(), '');
        
        if ($newUser->register()) {
            
            \Yii::$app->getResponse()->setStatusCode(201);
            
            return $newUser;
        }
        elseif (!$newUser->hasErrors()) {
            throw new ServerErrorHttpException('Failed to register user.');
        }
        
        return $newUser;
        
    }
}


