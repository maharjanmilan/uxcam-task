<?php
namespace api\common\models;

use yii\mongodb\ActiveRecord;
use yii\web\NotFoundHttpException;

class Company extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function collectionName()
	{
		return 'companies';
	}

    public function attributes()
    {
		return [
			'_id', 'name', 'address', 'phone',
            'created_at', 'updated_at'
		];
    }

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['_id'];
    }

    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            ['phone', 'string', 'min' => '10']
        ];
    }

    public static function findById($id)
    {
        $company = static::findOne($id);
        
        if(!$company)
            throw new NotFoundHttpException("Resource not found with id " . $id);

        return $company;
    }
}
