<?php

namespace artsoft\post\models;

use creocoder\nestedsets\NestedSetsBehavior;
use artsoft\behaviors\MultilingualBehavior;
use artsoft\models\OwnerAccess;
use Yii;
use yii\behaviors\BlameableBehavior;
use artsoft\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use artsoft\db\ActiveRecord;

/**
 * This is the model class for table "post_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $visible
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Category extends ActiveRecord implements OwnerAccess
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'visible'], 'integer'],
            [['description'], 'string'],
            [['slug', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),           
            [
                'class' => SluggableBehavior::className(),
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true           
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'post_category_id',
                'tableName' => "{{%post_category_lang}}",
                'attributes' => [
                    'title', 'description',
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                 'leftAttribute' => 'left_border',
                 'rightAttribute' => 'right_border',
                
            ],
        ];
    }

     public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'slug' => Yii::t('art', 'Slug'),
            'title' => Yii::t('art', 'Title'),
            'visible' => Yii::t('art', 'Visible'),
            'description' => Yii::t('art', 'Description'),
            'created_by' => Yii::t('art', 'Created By'),
            'updated_by' => Yii::t('art', 'Updated By'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    public static function getCategories()
    {
        return \yii\helpers\ArrayHelper::map(Category::find()->joinWith('translations')->leaves()->all(), 'id', 'title');
    }
    /**
     * 
     * @return type
     */
    public static function getCategoriesMenu()
    {
        return \yii\helpers\ArrayHelper::map(Category::find()->joinWith('translations')->leaves()->all(), 'slug', 'title');
    }
    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullPostCategoryAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
}