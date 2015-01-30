<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 28.01.2015
 */

namespace app\modules\main\widgets;

use Yii;
use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
    /**
     * Рендерит виджет datepicker
     * https://github.com/2amigos/yii2-date-picker-widget/
     * @param string $format - формат даты
     * @param array $options - аттрибуты поля (name => value)
     * @param string $language - код языка, по умолчанию - язык приложения
     * @return static the field object itself
     */
    public function dateInput($format = 'yyyy-MM-dd', $options = ['class' => 'form-control'], $language = null)
    {
        $this->options = ['style' => 'width: 200px'];

        if ($language === null) {
            $language = preg_replace('/(\-|\_).+$/', '', Yii::$app->language);
        }

        if ($this->template === "{label}\n{input}\n{hint}\n{error}") {
            $addon = '<i class="glyphicon glyphicon-calendar"></i>';
            $this->template = "{label}\n<div class=\"input-group\"><span class=\"input-group-addon\">{$addon}</span>\n{input}</div>\n{hint}\n{error}";
        }

        return $this->widget(\yii\jui\DatePicker::className(), [
                'options'  => array_merge(
                    $options,
                    [
                        'readonly' => true,
                    ]
                ),
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear'  => true
                ],
                'language'   => $language,
                'dateFormat' => $format,

            ]);
    }

    /**
     * Рендерит виджет DateTimePicker
     * https://github.com/2amigos/yii2-date-time-picker-widget
     * @param string $position - позиция виджета, нужно указывать, т.к. виджет дурак, и сам не понимает (top, bottom)
     * @param string $format - формат даты
     * @param array $options - аттрибуты поля (name => value)
     * @param string $language - код языка, по умолчанию - язык приложения
     * @return static the field object itself
     */
    public function datetimeInput($position = 'bottom', $format = 'yyyy-mm-dd HH:ii:ss', $options = [], $language = null)
    {
        $this->options = ['style' => 'width: 200px'];

        if ($language === null) {
            $language = preg_replace('/(\-|\_).+$/', '', Yii::$app->language);
        }

        return $this->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
                'language'       => $language,
                'template'       => '{button}{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                'options'        => $options,
                'clientOptions' => [
                    'maxView'        => 1,
                    'autoclose'      => true,
                    'format'         => $format,
                    'pickerPosition' => $position.'-right',
                ]
            ]);
    }

    /**
     * Рендерит визуальный редактор
     * @param array $options - аттрибуты поля (name => value)
     * @param string $preset - набор плагинов (basic, standart, full)
     * @param string $language - код языка, по умолчанию - язык приложения
     * @return static the field object itself
     */
    public function editor($options = [], $preset = 'custom')
    {
        return $this->ckeditor($options, $preset);
    }

    /**
     * Рендерит виджет ckeditor
     * https://github.com/2amigos/yii2-ckeditor-widget
     * @param array $options - аттрибуты поля (name => value)
     * @param string $preset - набор плагинов (basic, standart, full)
     * @return static the field object itself
     */
    public function ckeditor($options = [], $preset = 'custom')
    {
        /**
         * [ 'name' => 'forms', 'items' => [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] ],
         * [ 'name' => 'colors', 'items' => [ 'TextColor', 'BGColor' ] ],
         * [ 'name' => 'about', 'items' => [ 'About' ] ],
         */
        return $this->widget(\mihaildev\ckeditor\CKEditor::className(), [
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                        'inline'        => false,
                        'options'       => $options,
                        'height'        => 400,
                        'toolbar' => [
                            [ 'name' => 'document', 'groups' => [ 'mode', 'document', 'doctools' ], 'items' => [ 'Source', '-', 'Save', 'Templates' ] ],
                            [ 'name' => 'clipboard', 'groups' => [ 'clipboard', 'undo' ], 'items' => [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] ],
                            [ 'name' => 'editing', 'groups' => [ 'find', 'selection', 'spellchecker' ], 'items' => [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] ],
                            [ 'name' => 'basicstyles', 'groups' => [ 'basicstyles', 'cleanup' ], 'items' => [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] ],
                            '/',
                            [ 'name' => 'styles', 'items' => [ 'Styles', 'Format', 'Font', 'FontSize' ] ],
                            [ 'name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align' ], 'items' => [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] ],
                            [ 'name' => 'links', 'items' => [ 'Link', 'Unlink', 'Anchor' ] ],
                            [ 'name' => 'insert', 'items' => [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak', 'Iframe' ] ],
                            [ 'name' => 'tools', 'items' => [ 'Maximize', 'ShowBlocks' ] ],
                        ],
                        'removeButtons'  => 'Font,FontSize',
                        'allowedContent' => true
                    ])
            ]);
    }

    public function maskedInput($mask = '99.99.9999', $options = ['class' => 'form-control'])
    {
        return $this->widget(\yii\widgets\MaskedInput::className(), [
                'mask'    => $mask,
                'options' => $options
            ]);
    }

    public function phoneInput($options = ['class' => 'form-control'])
    {
        return $this->maskedInput('+7 (999) 999-99-99', $options);
    }

    /**
     * php composer.phar require kartik-v/yii2-widget-select2 "*"
     * "kartik-v/yii2-widget-select2": "*"
     */
    public function tagsInput($tags = [], $separator = '~~~', $options = ['class' => 'form-control'], $language = null)
    {
        if (class_exists('\kartik\select2\Select2') === false) {
            return parent::textInput($options);
        }

        if ($language === null) {
            $language = preg_replace('/(\-|\_).+$/', '', Yii::$app->language);
        }

        return $this->widget(\kartik\select2\Select2::className(), [
                'pluginOptions' => [
                    'language'  => $language,
                    'tags'      => array_values($tags),
                    'separator' => $separator
                ],
            ]);
    }

    public function ace()
    {
        return $this->widget(\trntv\aceeditor\AceEditor::className(), []);
    }
}