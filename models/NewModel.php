<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "new".
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $date
 * @property string $author
 *
 * @property NewImage[] $newImages
 */
class NewModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_description', 'description', 'date', 'author'], 'required'],
            [['title', 'short_description', 'description', 'date', 'author'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'date' => 'Date',
            'author' => 'Author',
        ];
    }

    /**
     * Gets query for [[NewImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewImages()
    {
        return $this->hasMany(NewImage::className(), ['new_id' => 'id']);
    }
}
