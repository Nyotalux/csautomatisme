<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $entity_type
 * @property int $entity_id
 * @property string $image
 * @property string|null $caption
 * @property int|null $sort_order
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Gallery extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caption', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['entity_type', 'entity_id', 'image'], 'required'],
            [['entity_id', 'sort_order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['entity_type'], 'string', 'max' => 50],
            [['image', 'caption'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_type' => 'Entity Type',
            'entity_id' => 'Entity ID',
            'image' => 'Image',
            'caption' => 'Caption',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
