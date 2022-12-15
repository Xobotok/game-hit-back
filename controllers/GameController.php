<?php

namespace app\controllers;

use app\models\Document;
use app\models\Game;
use app\models\GameCategory;
use app\models\GameImage;
use app\search\GameSearch;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends BaseController
{
    public function actionGetGame() {
        $game = (new \yii\db\Query());
        $game
            ->select(['*', Game::tableName() .'.id as id', GameCategory::tableName() . '.title as category_title',
                Game::tableName() . '.title as title',
                Game::tableName() . '.description as description',
                GameCategory::tableName() . '.description as category_description',
                Document::tableName().'.link as image',
                ])
            ->from(Game::tableName())
            ->leftJoin(GameCategory::tableName(),Game::tableName(). '.category_id=' . GameCategory::tableName() .'.id')
            ->leftJoin(GameImage::tableName(), Game::tableName() . '.id=' . GameImage::tableName() . '.game_id')
            ->leftJoin(Document::tableName(), Document::tableName() . '.id=' . GameImage::tableName() . '.document_id')
            ->where([Game::tableName().'.id' => $this->get()->id]);
        return $this->createAnswer(1, $game->one(), 'Игра найдена');
    }
    public function actionGetGames() {
        $games = (new \yii\db\Query());
        $games
            ->select(['*', GameCategory::tableName() . '.title as category_title',
                Game::tableName() . '.title as title',
                Game::tableName() . '.description as description',
                GameCategory::tableName() . '.description as category_description'])
            ->from(Game::tableName())
            ->leftJoin(GameCategory::tableName(),Game::tableName(). '.category_id=' . GameCategory::tableName() .'.id');
        $count = $games->count();
        if($this->get()->limit) {
            $games->limit = $this->get()->limit;
        }
        if($this->get()->offset) {
            $games->offset = $this->get()->offset;
        }
        $games = $games->all();
        $data = (object)[];
        $data->games = $games;
        $data->total = $count;
        return $this->createAnswer(1, $data);
    }
}
