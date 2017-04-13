<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Content;

/**
 * ContentSearch represents the model behind the search form about `backend\models\Content`.
 */
class ContentSearch extends Content
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ordering'], 'integer'],
            [['slider', 'how_to_earn', 'investor_pakage', 'other_investor_diff', 'most_active_users', 'calculator', 'articles', 'content_type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Content::find();

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
            'ordering' => $this->ordering,
        ]);

        $query->andFilterWhere(['like', 'slider', $this->slider])
            ->andFilterWhere(['like', 'how_to_earn', $this->how_to_earn])
            ->andFilterWhere(['like', 'investor_pakage', $this->investor_pakage])
            ->andFilterWhere(['like', 'other_investor_diff', $this->other_investor_diff])
            ->andFilterWhere(['like', 'most_active_users', $this->most_active_users])
            ->andFilterWhere(['like', 'calculator', $this->calculator])
            ->andFilterWhere(['like', 'articles', $this->articles])
            ->andFilterWhere(['like', 'content_type', $this->content_type]);

        return $dataProvider;
    }
}
