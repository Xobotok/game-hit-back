<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $poster_image
 * @property string|null $gameplay_image
 * @property string|null $small_icon_image
 * @property string|null $video
 * @property string $developer
 * @property string $publisher
 * @property string $release_date
 * @property string $platform
 * @property int $status
 * @property string|null $short_description
 * @property string $rating
 *
 * @property GameCategory[] $gameCategories
 * @property GameImage[] $gameImages
 * @property PromoGames[] $promoGames
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $poster_image_file;
    public $small_icon_file;
    public $gameplay_image_file;
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
            [['title', 'description', 'developer', 'publisher', 'release_date', 'platform', 'rating'], 'required'],
            ['poster_image_file', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxSize' => 10512000,
                'tooBig' => 'Limit is 500KB'
            ],
            ['small_icon_file', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxSize' => 512000, // 500 килобайт = 500 * 1024 байта = 512 000 байт
                'tooBig' => 'Limit is 500KB'
            ],
            ['gameplay_image_file', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxSize' => 10512000, // 3500 килобайт = 500 * 1024 байта = 512 000 байт
                'tooBig' => 'Limit is 500KB'
            ],
            [['title', 'poster_image', 'description', 'gameplay_image', 'small_icon_image', 'video', 'developer', 'publisher', 'release_date', 'platform', 'short_description'], 'string'],
            [['status'], 'integer'],
            [['rating'], 'string', 'max' => 4],
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
            'poster_image' => 'Poster Image',
            'gameplay_image' => 'Gameplay Image',
            'small_icon_image' => 'Small Icon Image',
            'video' => 'Video',
            'developer' => 'Developer',
            'publisher' => 'Publisher',
            'release_date' => 'Release Date',
            'platform' => 'Platform',
            'status' => 'Status',
            'short_description' => 'Short Description',
            'rating' => 'Rating',
        ];
    }

    /**
     * Gets query for [[GameCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameCategories()
    {
        $categories =  $this->hasMany(GameCategory::className(), ['game_id' => 'id'])->all();
        $result = [];
        foreach ($categories as $category) {
            $item = $category->category;
            $result[] = $item;
        }
        return $result;
    }
    /**
     * Gets query for [[GameImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameImages()
    {
        return $this->hasMany(GameImage::className(), ['game_id' => 'id']);
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
