<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 14.01.2015
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\LoginForm */
$this->title = 'Вход';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0">
                Если Вы забыли свой пароль вы можете <?= Html::a('сбросить его', ['/user/default/request-password-reset']) ?>.
            </div>
            <div class="form-group">
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>