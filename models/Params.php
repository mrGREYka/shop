<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property int $id
 * @property string $three_shiping_sum
 * @property string $cdek_url
 * @property int $up_1
 * @property int $up_2
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['three_shiping_sum', 'up_1', 'up_2', 'pickup', 'price_сourier', 'russia_mail' ], 'integer'],
            [['cdek_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'three_shiping_sum' => 'Минимальная сумма бесплатной доставки',
            'cdek_url' => 'Главная страница СДЭК',
            'up_1' => 'Наценка на срочную доставку (1-ый день)',
            'up_2' => 'Наценка на срочную доставку (2-ой день)',
            'pickup' => 'Цена за самовывоз',
            'price_сourier' => 'Цена за доставку курьером',
            'russia_mail' => 'Цена за доставку почтой'
        ];
    }
}
