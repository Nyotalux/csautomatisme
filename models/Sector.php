<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sector".
 *
 * @property int $id
 * @property int|null $service_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string|null $icon
 * @property string|null $animation
 * @property int|null $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Service $service
 */
class Sector extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'description', 'image', 'icon', 'animation', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['service_id', 'sort_order'], 'integer'],
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'image'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 100],
            [['animation'], 'string', 'max' => 50],
            [['slug'], 'unique'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'image' => 'Image',
            'icon' => 'Icon',
            'animation' => 'Animation',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

}
