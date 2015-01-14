<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 14.01.2015
 */

namespace app\modules\user\models;

use yii\base\Model;
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\modules\user\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Нет пользователя с таким E-Mail.'
            ],
        ];
    }
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);
        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }
            if ($user->save()) {
                return \Yii::$app->mailer->compose('/mail/passwordResetToken', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Восстановление пароля ' . \Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'email'=>'E-Mail',
        ];
    }
}