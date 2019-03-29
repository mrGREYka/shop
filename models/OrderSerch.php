<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * orderSerch represents the model behind the search form of `app\models\order`.
 */
class orderSerch extends order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id', 'number', 'dost', 'product_id', 'type_id', 'taste_id', 'count', 'sum', 'has_box'], 'integer'],
            //[['created', 'email', 'phone', 'address', 'datefinish', 'timefinish', 'comment', 'message', 'promocode', 'username', 'uri', 'url'], 'safe'],
            [['number',], 'integer'],
            [['email', 'phone','username',], 'safe'],

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
        $query = Order::find()->orderBy([ 'created' => SORT_DESC ]);

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
            'number' => $this->number,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
