<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * orderSerch represents the model behind the search form of `app\models\order`.
 */
class OrderWarehouseSerch extends order
{

    public $from_date;
    public $to_date;

    /**
     *
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status','paid','dost'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
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
        //$query = Order::find()->orderBy(['id' => SORT_ASC]);
        $query = Order::find();

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

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere([
            'paid' => $this->paid,
        ]);

        $query->andFilterWhere([
            'dost' => $this->dost,
        ]);

        // grid filtering conditions

        $query->andFilterWhere(['or',
            'status='.Order::STATUS_PRINTED,
            'status='.Order::STATUS_COLLECTED,
        ]);

        return $dataProvider;
    }
}
