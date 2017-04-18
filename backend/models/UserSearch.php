<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'starting_amount', 'purse', 'invitation_users_count', 'status', 'activity_status'], 'integer'],
            [['username', 'first_name', 'last_name', 'email', 'password', 'bio', 'gender', 'dob', 'pic', 'country', 'state', 'city', 'address', 'phone', 'mobile_phone', 'postal', 'referal_link', 'auth_key', 'remember_token', 'password_token', 'api_key', 'social_type', 'social_id', 'social_user_name', 'referal_link_created', 'deleted_at', 'created', 'updated'], 'safe'],
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
        $query = User::find()->where('role != :role', ['role'=>0]);

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
            'role' => $this->role,
            'dob' => $this->dob,
            'starting_amount' => $this->starting_amount,
            'purse' => $this->purse,
            'invitation_users_count' => $this->invitation_users_count,
            'status' => $this->status,
            'activity_status' => $this->activity_status,
            'referal_link_created' => $this->referal_link_created,
            'deleted_at' => $this->deleted_at,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'postal', $this->postal])
            ->andFilterWhere(['like', 'referal_link', $this->referal_link])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'remember_token', $this->remember_token])
            ->andFilterWhere(['like', 'password_token', $this->password_token])
            ->andFilterWhere(['like', 'api_key', $this->api_key])
            ->andFilterWhere(['like', 'social_type', $this->social_type])
            ->andFilterWhere(['like', 'social_id', $this->social_id])
            ->andFilterWhere(['like', 'social_user_name', $this->social_user_name]);

        return $dataProvider;
    }
}
