<?php
use yii\helpers\Html;
?>
<div class="row sortable">
    <? foreach ($model as $data) : ?>
        <div class="col-xs-2 sort-item" data-file_id="<?= $data->id ?>">
            <span class="thumbnail" style="word-break: break-all; background-color: #f0f0f0">
                <button type="button" class="close delete-file" data-file_id="<?= $data->id ?>" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                <a href="<?= $data->file ?>" target="_blank">
                    <? if ($data->isImage()) : ?>
                        <?= Html::img($data->thumb(0, 100, 'out', 70), ['class' => '']) ?>
                    <? else : ?>
                        <?= basename($data->file) ?>
                    <? endif ?>
                </a>
            </span>
        </div>
    <? endforeach ?>
</div>