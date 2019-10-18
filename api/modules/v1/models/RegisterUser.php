<?php
namespace api\modules\v1\models;

use yii\base\Model;
use api\common\models\User;

class RegisterUser extends Model
{
    public $name;
    public $date_of_birth;
    public $country;
    public $profession;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country', 'profession', 'date_of_birth'], 'default'],
            
            [['name','country', 'profession', 'date_of_birth','email'], 'trim'],
            
            [['name', 'email', 'password'], 'required'],
            
            ['name', 'string', 'min' => 2, 'max' => 255],

            
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\api\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],

            ['date_of_birth', 'date', 'format'=>'yyyy/M/d', 'message' => 'Please enter correct date format YYYY/MM/DD']
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->date_of_birth = $this->date_of_birth;
        $user->country = $this->country;
        $user->profession = $this->profession;
        $user->setPassword($this->password);
        return $user->save();

    }

}
