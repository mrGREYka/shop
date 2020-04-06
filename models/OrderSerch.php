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
            //[['id', 'number', 'dost', 'product_id', 'type_id', 'taste_id', 'count', 'sum', 'has_box'], 'integer'],
            //[['created', 'email', 'phone', 'address', 'datefinish', 'timefinish', 'comment', 'message', 'promocode', 'username', 'uri', 'url'], 'safe'],
            [['from_date','to_date'], 'safe'],
            [['id','user_id','status'], 'integer'],
           // [['partner_id'], 'safe'],

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere([
            'status' => $this->status,
        ]);


        $query->andFilterWhere(['like', 'id', $this->id]);

        /*var_dump( $this->from_date );
        var_dump(strtotime($this->from_date));
        var_dump(date("Y-m-d",strtotime($this->from_date)));*/


        if ($this->from_date && $this->to_date) {
            $query->andFilterWhere(['between', 'created', date("Y-m-d", strtotime($this->from_date)), date("Y-m-d", strtotime($this->to_date)+86400)]);
        };

        return $dataProvider;
    }
}
