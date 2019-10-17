<?php

namespace api\common\controllers;

use yii\rest\Controller;

class AuthController extends Controller
{   
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['authenticator'] = [
            'class' => \bizley\jwt\JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    } 

}


