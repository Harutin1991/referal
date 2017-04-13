<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrHowToEarn;

/**
 * TrHowToEarnSearch represents the model behind the search form about `backend\models\TrHowToEarn`.
 */
class TrHowToEarnSearch extends TrHowToEarn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'how_to_earn_id', 'language_id'], 'integer'],
            [['short_description'], 'safe'],
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
        $query = TrHowToEarn::find();

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
            'how_to_earn_id' => $this->how_to_earn_id,
            'language_id' => $this->language_id,
        ]);

        $query->andFilterWhere(['like', 'short_description', $this->short_description]);

        return $dataProvider;
    }
}
