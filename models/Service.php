<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property int|null $department_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $content
 * @property string|null $image_main
 * @property string|null $icon
 * @property string|null $animation
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property int|null $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Department $department
 * @property Sector[] $sectors
 * @property User[] $users
 */
class Service extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'description', 'content', 'image_main', 'icon', 'animation', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['department_id', 'sort_order'], 'integer'],
            [['name', 'slug'], 'required'],
            [['description', 'content', 'meta_description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'image_main', 'meta_keywords'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 100],
            [['animation'], 'string', 'max' => 50],
            [['slug'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'content' => 'Content',
            'image_main' => 'Image Main',
            'icon' => 'Icon',
            'animation' => 'Animation',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Sectors]].
     *
     * @return \yii\db\ActiveQuery
     */
  

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['service_id' => 'id']);
    }

    /**
 * @return \yii\db\ActiveQuery
 */
public function getSectors()
{
    return $this->hasMany(Sector::class, ['service_id' => 'id'])->orderBy(['sort_order' => SORT_ASC]);
}

/**
 * @return \yii\db\ActiveQuery
 */
public function getGallery()
{
    return $this->hasMany(Gallery::class, ['entity_id' => 'id'])
        ->andOnCondition(['entity_type' => 'service'])
        ->orderBy(['sort_order' => SORT_ASC]);
}

}
