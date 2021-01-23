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
            [['from_date','to_date'], 'safe'],
            [['id','user_id','status'], 'integer'],
            [['sum_total'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'from_date' => 'Дата начала',
            'to_date' => 'Дата окончания',
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere([
            'sum_total' => $this->sum_total,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id]);

        if ($this->from_date){
        $query->andFilterWhere(['>=', 'created', date("Y-m-d", strtotime($this->from_date))]);
            }

        if ($this->to_date){
            $query->andFilterWhere(['<=', 'created', date("Y-m-d", strtotime($this->to_date)+86400)]);
        }

        return $dataProvider;
    }
}
