<?php

namespace ikhlas\product\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property string $price
 * @property integer $status
 * @property string $detail
 * @property integer $created_at
 * @property integer $created_by
 *
 * @property CreditDetail[] $creditDetails
 * @property User $createdBy
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['type', 'status', 'created_at', 'created_by'], 'integer'],
            [['price'], 'number'],
            [['detail'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'รหัสสินค้า'),
            'title' => Yii::t('product', 'สินค้า'),
            'type' => Yii::t('product', 'ประเภท'),
            'price' => Yii::t('product', 'ราคา'),
            'status' => Yii::t('product', 'สถานะ'),
            'detail' => Yii::t('product', 'รายละเอียด'),
            'created_at' => Yii::t('product', 'สร้างเมื่อ'),
            'created_by' => Yii::t('product', 'สร้างโดย'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditDetails()
    {
        return $this->hasMany(CreditDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredits()
    {
        return $this->hasMany(Credit::className(), ['id' => 'credit_id'])->viaTable('credit_detail', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
