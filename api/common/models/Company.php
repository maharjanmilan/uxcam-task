<?php
namespace api\common\models;

use api\traits\ReadableTimeStampDate;
use yii\mongodb\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;

class Company extends ActiveRecord
{
    
    use ReadableTimeStampDate;

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
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
