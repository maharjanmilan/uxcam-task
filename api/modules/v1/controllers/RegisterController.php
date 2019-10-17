<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

class RegisterController extends Controller
{   
    public function actionIndex()
    {
        return time();
    }

    public function actionMilan()
    {
        return "I am the lord";
    }
}


