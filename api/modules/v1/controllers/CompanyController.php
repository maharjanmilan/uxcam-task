<?php

namespace api\modules\v1\controllers;

use Yii;
use api\traits\JwtAuth;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use api\common\models\Company;

class CompanyController extends Controller
{   
    use JwtAuth;

    public function actionIndex()
    {
        $companies = Company::find();

        return  new ActiveDataProvider([
            'query' => $companies,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

    }

    public function actionView($id)
    {
        return Company::findById($id);
    }

    public function actionCreate()
    {
        $company = new Company();

        $company->load(\Yii::$app->request->post(), '');
        
        if ($company->save()) {
            
            \Yii::$app->getResponse()->setStatusCode(201);
            
            return $company;
        }
        elseif (!$company->hasErrors()) {
            throw new ServerErrorHttpException('Failed to add company.');
        }
        
        return $company;
    }

    public function actionUpdate($id)
    {
        $company = Company::findById($id);

        $company->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($company->save() === false && !$company->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update company.');
        }

        return $company;
    }

    public function actionDelete($id)
    {
        $company = Company::findById($id);
        
        if ($company->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete company.');
        }

        Yii::$app->getResponse()->setStatusCode(204);
    }

}


