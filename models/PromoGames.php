<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promo_games".
 *
 * @property int $id
 * @property int $game_id
 * @property int $number
 *
 * @property Game $game
 */
class PromoGames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id'], 'required'],
            [['game_id', 'number'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'number' => 'Number',
        ];
    }

    /**
     * Gets query for [[Game]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }
}
