<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "game_image".
 *
 * @property int $id
 * @property int $document_id
 * @property int $game_id
 *
 * @property Document $document
 * @property Game $game
 */
class GameImage extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $files;
    public function upload($image_id)
    {
        $i = 0;
        foreach ($this->files as $file) {
            $fileDb = new static();
            $fileDb->game_id = $image_id;
            $fileDb->save();
            $doc =new Document();
            $doc->link = "";
            $doc->name= ArrayHelper::getValue(  Yii::$app->request->post(),"GameImage.name.".$i);;
            $doc->old_name = $file->baseName.'.'.$file->extension;
            $doc->save();
            $fileDb->updateAttributes(['document_id'=>$doc->id]);
            $dir = Yii::getAlias("@app")."/game-images/";
            if(!is_dir($dir)) mkdir($dir, 0777, true);
            $file->saveAs("{$dir}/{$doc->id}.{$file->extension}");
            $i++;
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_id', 'game_id'], 'required'],
            [['document_id', 'game_id'], 'integer'],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['document_id' => 'id']],
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
            'document_id' => 'Document ID',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * Gets query for [[Document]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
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
