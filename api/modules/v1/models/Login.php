<?php
namespace api\modules\v1\models;

use api\classes\JwtTokenGenerator;
use api\common\models\User;
use Yii;
use yii\base\Model;

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

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
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

     /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

     /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

}
