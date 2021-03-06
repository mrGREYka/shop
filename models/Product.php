<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $group_product_id
 *
 * @property GroupProduct $groupProduct
 */
class Product extends \yii\db\ActiveRecord
{
    const HAS_BOX_NO    = 0;
    const HAS_BOX_YES   = 1;

    const WITHOUT_PHOTO_NO  = 0;
    const WITHOUT_PHOTO_YES = 1;

    const KIT_NO    = false;
    const KIT_YES   = true;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['group_product_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['group_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupProduct::className(), 'targetAttribute' => ['group_product_id' => 'id']],
            [['has_box', 'sort'],'integer'],
            ['has_box', 'default', 'value' => self::HAS_BOX_NO ],
            ['has_box', 'in', 'range' => [
                self::HAS_BOX_NO,
                self::HAS_BOX_YES,
            ]],
            ['without_photo', 'default', 'value' => self::WITHOUT_PHOTO_NO ],
            ['without_photo', 'in', 'range' => [
                self::WITHOUT_PHOTO_NO,
                self::WITHOUT_PHOTO_YES,
            ]],
            [['kit'], 'boolean'],
            ['kit', 'default', 'value' => false ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'content' => 'Описание',
            'group_product_id' => 'Группа товаров',
            'has_box' => 'Это набор',
            'without_photo' => 'Без фотографий',
            'kit' => 'Штучный',
            'sort' => 'Порядок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupProduct()
    {
        return $this->hasOne(GroupProduct::className(), ['id' => 'group_product_id']);
    }

    public function getFiles( )
    {
        return $this->hasMany( FileProduct::className( ), [ 'product_id' => 'id' ] )->orderBy(['sort' => SORT_ASC ]);
    }

    public function getAttributes_( )
    {
        return $this->hasMany( AttributeProduct::className( ), [ 'product_id' => 'id' ] )->orderBy(['id' => SORT_ASC ]);
    }

    public function getPrice( )
    {
        return $this->hasMany( PriceProduct::className( ), [ 'product_id' => 'id' ] )->orderBy(['min_count' => SORT_ASC ]);
    }

    /*public function getTaste( )
    {
        return $this->hasMany( TasteProduct::className( ), [ 'product_id' => 'id' ] )->orderBy(['id' => SORT_ASC ]);
    }*/

    public function getTasteproduct()
    {
        return $this->hasMany(TasteProduct::className(), ['product_id' => 'id']);
    }

    public function getTaste()
    {
        return $this->hasMany(Taste::className(), ['id' => 'taste_id'])->via('tasteproduct')->orderBy(['id' => SORT_ASC ]);
    }

    public function getPriceByCount( $count )
    {
        $prices = $this->price;
        $count_price = count( $prices );

        // если цены не указаны, тогда цена 0
        if ( $count_price === 0 ) {
            return 0;
        }

        // если кол-во ниже минимального, тогда цена 0
        if ( $count < $prices[0]->min_count ) {
            return 0;
        }

        // если кол-во ,больше или равно максимальному, тогда самая привлекательная цена
        if ( $count >= $prices[$count_price - 1]->min_count ) {
            return $prices[$count_price - 1]->price;
        }

        $i = 0;
        while ( $i < ( $count_price ) ) {
            if ( $count < $prices[$i]->min_count ) {
                return $prices[$i-1]->price;
            }
            $i++;
        }
    }
}
