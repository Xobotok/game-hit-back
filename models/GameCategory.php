<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_category".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $image
 *
 * @property Game[] $games
 */
class GameCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description', 'image'], 'string'],
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
            'description' => 'Description',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Games]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['category_id' => 'id']);
    }
}
