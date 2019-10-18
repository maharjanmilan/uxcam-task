<?php

namespace api\modules\v1\controllers;

use Yii;
use api\common\controllers\AuthController;
use api\common\models\User;
use api\modules\v1\models\RegisterUser;
use yii\rest\ActiveController;

class UserController extends AuthController
{   
    public $modelClass = User::class;
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['authenticator']['optional'] = [
            'create'
        ];

        return $behaviors;
    } 

    public function actionMilan()
    {
        $user =  Yii::$app->user->identity;
        return "I am the lord";
    }

    // public function actionCreate()
    // {
    //     $newUser = new RegisterUser();
        
    //     if ($newUser->load(Yii::$app->request->post(), '') && $newUser->register()) {
    //         return $newUser;
    //     }
    //     //$newUser->validate();
    //     return $newUser->getErrors();

    // }
}


