<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\InvsetorPackages;

/**
 * InvsetorPackagesSearch represents the model behind the search form about `backend\models\InvsetorPackages`.
 */
class InvsetorPackagesSearch extends InvsetorPackages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'default_package'], 'integer'],
            [['title', 'description', 'create_date', 'update_date'], 'safe'],
            [['price'], 'number'],
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
        $query = InvsetorPackages::find();

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
            'price' => $this->price,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'default_package' => $this->default_package,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
