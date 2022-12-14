<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Game;

/**
 * GameSearch represents the model behind the search form of `app\models\Game`.
 */
class GameSearch extends Game
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'category_id'], 'integer'],
            [['title', 'description', 'big_icon_link', 'small_icon_link', 'video', 'developer', 'publisher', 'release_date', 'platform', 'short_description', 'dscription'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Game::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'big_icon_link', $this->big_icon_link])
            ->andFilterWhere(['like', 'small_icon_link', $this->small_icon_link])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'developer', $this->developer])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'release_date', $this->release_date])
            ->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'dscription', $this->dscription]);

        return $dataProvider;
    }
}
