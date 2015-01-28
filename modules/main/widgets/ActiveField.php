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

    /**
     * Рендерит поле для выбора файла из elfinder
     * https://github.com/MihailDev/yii2-elfinder
     * @param boolean $multiple - возможность мультивыбора
     * @param string|array $filter - mime типы доступных файлов
     * @return static the field object itself
     */
    public function fileFinderInput($multiple = false, $filter = null, $language = null, $options = [])
    {
        if (class_exists('\mihaildev\elfinder\InputFile') === false) {
            return parent::fileInput($options);
        }

        if ($language === null) {
            $language = preg_replace('/(\-|\_).+$/', '', Yii::$app->language);
        }

        return $this->widget(InputFile::className(), [
                'language'      => $language,
                'controller'    => 'elfinder', // вставляем название контроллера по умолчанию равен elfinder
                'filter'        => $filter,    // фильтр файлов, можно задать масив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'template'      => '<div class="panel panel-default"><div class="panel-body">{files}<div class="input-group">{input}<span class="input-group-btn">{button}</span></div></div></div>',
                'options'       => [
                    'class'    => 'form-control',
                    'readonly' => true,
                ],
                'multiple'      => $multiple,
                'buttonName'    => '<i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;'.Yii::t('app', 'Обзор&hellip;'),
                'buttonOptions' => ['class' => 'btn btn-success'],
            ]);
    }

    /**
     * Рендерит поле для мульти загрузки файлов
     * @return static the field object itself
     */
    public function filesInput()
    {
        return $this->fileFinderInput(true);
    }

    /**
     * Рендерит поле для загрузки изображения
     * @return static the field object itself
     */
    public function imageInput()
    {
        return $this->fileFinderInput(false, ['image']);
    }

    /**
     * Рендерит поле для мульти загрузки изображений
     * @return static the field object itself
     */
    public function imagesInput()
    {
        return $this->fileFinderInput(true, ['image']);
    }

    /**
     * Рендерит поле для загрузки файла
     * https://github.com/2amigos/yii2-file-input-widget
     * http://plugins.krajee.com/file-input
     * @param boolean $multiple - возможность мультиаплоада
     * @param string $accept - mime типы доступных файлов, можно маску, например: image/*
     * @return static the field object itself
     */
    public function fileUploadInput($multiple = false, $accept = null)
    {
        return $this->widget(\dosamigos\fileFinderInput\BootstrapfileFinderInput::className(), [
                'options' => ['accept' => $accept, 'multiple' => $multiple],
                'clientOptions' => [
                    'previewFileType' => 'any',
                    'browseClass'     => 'btn btn-success',
                    'showUpload'      => false,
                    'browseLabel'     => 'Обзор&hellip;',
                    'removeLabel'     => 'Удалить',
                    'removeClass'     => 'btn btn-danger',
                    'removeIcon'      => '<i class="glyphicon glyphicon-trash"></i> '
                ]
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
}