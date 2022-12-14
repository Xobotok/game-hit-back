<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $big_icon_link
 * @property string $small_icon_link
 * @property string $video
 * @property string $developer
 * @property string $publisher
 * @property string $release_date
 * @property string $platform
 * @property int $status
 * @property int $category_id
 * @property string|null $short_description
 * @property string|null $dscription
 *
 * @property GameCategory $category
 * @property PromoGames[] $promoGames
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'big_icon_link', 'small_icon_link', 'video', 'developer', 'publisher', 'release_date', 'platform', 'category_id'], 'required'],
            [['title', 'description', 'big_icon_link', 'small_icon_link', 'video', 'developer', 'publisher', 'release_date', 'platform', 'short_description', 'dscription'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GameCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'big_icon_link' => 'Big Icon Link',
            'small_icon_link' => 'Small Icon Link',
            'video' => 'Video',
            'developer' => 'Developer',
            'publisher' => 'Publisher',
            'release_date' => 'Release Date',
            'platform' => 'Platform',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'short_description' => 'Short Description',
            'dscription' => 'Dscription',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GameCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[PromoGames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPromoGames()
    {
        return $this->hasMany(PromoGames::className(), ['game_id' => 'id']);
    }
}
