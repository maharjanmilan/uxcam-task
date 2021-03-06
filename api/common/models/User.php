<?php
namespace api\common\models;

use api\traits\ReadableTimeStampDate;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\mongodb\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    use ReadableTimeStampDate;
	/**
	 * @inheritdoc
	 */
	public static function collectionName()
	{
		return 'users';
	}

    public function attributes()
    {
		return [
			'_id', 'name', 'date_of_birth', 'country', 'profession', 
            'email', 'password', 'registration_date',
            'created_at', 'updated_at'
		];
    }
    
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
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
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['_id' => $id]);
    }

    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {       
        return static::findOne(['_id' => (string) $token->getClaim('uid')]);
	}
	
	/**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function getCreatedArt()
    {
        return "a" . $this->created_at;
    }
	
}
