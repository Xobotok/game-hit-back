<?php

namespace app\controllers;

use app\models\Category;
use app\models\Document;
use app\models\Game;
use app\models\GameCategory;
use app\models\GameImage;
use app\search\GameSearch;
use yii\db\Expression;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends BaseController
{
    public function actionGetGame() {
        $game = Game::find()->where(['id' => $this->get()->id])->one();
        $game->visits = $game->visits + 1;
        $game->save();
        $data = (object)$game->attributes;
        $data->categories = $game->gameCategories;
        $data->images = $game->gameImages;
        return $this->createAnswer(1, $data, 'Игра найдена');
    }
    public function actionGetRecommendedGames() {
        $game = Game::find()->where(['id' => $this->get()->id])->one();
        $categories = $game->gameCategories;
        $games =  [];
        $gameCategory = GameCategory::find();
        foreach ($categories as $category) {
            $gameCategory->orWhere(['category_id' => $category->id]);
        }
        $gameCategory->andWhere(['!=', 'game_id', $game->id]);
        $gameCategory->offset(0)->limit(4)->orderBy(new Expression('rand()'));
        foreach ($gameCategory->all() as $game) {
            $games[] = $game->game;
        }
        return $this->createAnswer(1, $games, 'Игры найдены');
    }
    public function actionGetGames() {
        $games = Game::find()->orderBy(new Expression('rand()'));
        $count =  Game::find()->count();
        if($this->get()->limit) {
            $games->limit = $this->get()->limit;
        }
        if($this->get()->offset) {
            $games->offset = $this->get()->offset;
        }
        $games = $games->all();
        $result = [];
        foreach ($games as $game) {
            $item = (object)$game->attributes;
            $item->categories = $game->gameCategories;
            $item->images = $game->gameImages;
            $result[] = $item;
        }
        $data = (object)[];
        $data->games = $result;
        $data->total = $count;
        return $this->createAnswer(1, $data);
    }
    public function actionGetTopGames() {

    }
}
