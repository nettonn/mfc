<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 14.01.2015
 */

namespace app\modules\user\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(),],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(),],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha', 'captchaAction' => '/main/default/captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {
                Yii::$app->mailer->compose('/mail/confirmEmail', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Подтвержение E-Mail для ' . Yii::$app->name)
                    ->send();
            }

            return $user;
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'username'=>'Имя пользователя',
            'email'=>'E-Mail',
            'password'=>'Пароль',
            'verifyCode'=>'Защита от роботов',
        ];
    }
}