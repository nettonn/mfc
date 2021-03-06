<?php namespace app\modules\page\models;

use Yii;
use app\modules\main\models\BaseActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $parent_id
 * @property string $content
 * @property string $layout
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $seo_title
 * @property string $seo_h1
 * @property string $seo_keywords
 * @property string $seo_description
 */
class Page extends BaseActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'status'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['name', 'alias', 'seo_title', 'seo_h1', 'seo_keywords', 'seo_description'], 'string', 'max' => 255],
            [['layout'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'Псевдоним',
            'parent_id' => 'Родитель',
            'content' => 'Содержимое',
            'layout' => 'Шаблон',
            'status' => 'Активен',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'seo_title' => 'Seo Title',
            'seo_h1' => 'Seo H1',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'modelName'=>'Страницы',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getStatusName($id = false)
    {
        $statuses = self::getStatusesArray();
        if($id!==false) return isset($statuses[$id]) ? $statuses[$id] : '';
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_NOT_ACTIVE => 'Не активен',
        ];
    }
}
