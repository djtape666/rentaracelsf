<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $id
 * @property int $category_id
 * @property string $value
 *
 * @property CarCharacteristic[] $carCharacteristics
 * @property Category $category
 */
class Characteristic extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'value'], 'required'],
            [['category_id'], 'integer'],
            [['value'], 'string', 'max' => 256],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'value' => 'Описание',
        ];
    }

    /**
     * Gets query for [[CarCharacteristics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarCharacteristics()
    {
        return $this->hasMany(CarCharacteristic::class, ['characteristic_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

}
