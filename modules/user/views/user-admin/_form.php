<?php

use yii\helpers\Html;
use app\modules\main\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\BaseActiveRecord */
/* @var $form app\modules\main\widgets\ActiveForm */
?>

<div class="<?= $this->context->id ?>-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'role')->dropDownList($model->getRolesArray(), ['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusesArray(), ['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Добавить и выйти' : 'Сохранить и выйти', ['class' => 'btn btn-primary', 'name'=>'save-exit', 'value'=>1]) ?>
        <? if(method_exists($model, 'getUrl')): ?>
            <?= Html::submitButton($model->isNewRecord ? 'Добавить и показать' : 'Сохранить и показать', ['class' => 'btn btn-primary', 'name'=>'save-show', 'value'=>1]) ?>
        <? endif ?>
        <?= Html::submitButton($model->isNewRecord ? 'Добавить и создать' : 'Сохранить и добавить', ['class' => 'btn btn-primary', 'name'=>'save-add', 'value'=>1]) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
