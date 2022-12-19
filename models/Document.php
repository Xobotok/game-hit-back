<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $old_name
 *
 * @property GameImage[] $gameImages
 * @property NewImage[] $newImages
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'link', 'old_name'], 'required'],
            [['name', 'link', 'old_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'old_name' => 'Old Name',
        ];
    }

    /**
     * Gets query for [[GameImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameImages()
    {
        return $this->hasMany(GameImage::className(), ['document_id' => 'id']);
    }

    /**
     * Gets query for [[NewImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewImages()
    {
        return $this->hasMany(NewImage::className(), ['document_id' => 'id']);
    }
}
