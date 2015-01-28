<?php

namespace app\modules\main\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class InputFile extends \mihaildev\elfinder\InputFile
{
    public function run()
    {
        ob_start();
        parent::run();
        $out = ob_get_contents();
        ob_end_clean();

        $attr = $this->attribute;
        $replace['{files}'] = $this->render('input_files', [
                'model' => $this->model->$attr ? $this->model->$attr->all() : null
            ]);

        $urlDelete = Url::to(['delete-file']);
        $urlSort   = Url::to(['sort-file']);

        $js = <<<EOF
$(function() {
    $('.delete-file').on('click', function() {
        if (!confirm('Удалить файл?')) return false;
        var id = $(this).data('file_id');
        $.post('$urlDelete', { id: id });
        $('.sort-item[data-file_id='+id+']').remove();
    });

    $('.sortable').sortable({
        cursor: "move",
        stop: function(event, ui) {
            var el = $(ui.item.context);
            var parent = el.parent();
            var ids = [];
            parent.find('.sort-item').each(function() {
                ids.push($(this).data('file_id'));
            });
            $.post('$urlSort', { ids: ids });
        }
    });
    $('.sortable').disableSelection();
});
EOF;

        $view = $this->getView();
        \yii\jui\JuiAsset::register($view);
        $view->registerJs($js);

        return strtr($out, $replace);
    }
}