<?php
namespace api\modules\v1\models;

use yii\base\Model;
use api\common\models\User;
use api\classes\JwtTokenGenerator;

class Login extends Model
{
    public $email;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'trim'],
            
            [['email', 'password'], 'required'],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
    }

    public function attemptLogin()
    {
        return $this->validate();
    }

    public function generateToken()
    {
        return (string) JwtTokenGenerator::getToken([
            'uid' => (string) $this->_user->_id,
            'email' => $this->_user->email
        ]);
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

}
