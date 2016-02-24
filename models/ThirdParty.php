<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qt_third_party".
 *
 * @property integer $id
 * @property string $hardware
 * @property double $canadaPrice
 * @property double $usPrice
 */
class ThirdParty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qt_third_party';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hardware', 'canadaPrice', 'usPrice'], 'required'],
            [['canadaPrice', 'usPrice'], 'number'],
            [['hardware'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hardware' => 'Hardware',
            'canadaPrice' => 'Canada Price',
            'usPrice' => 'Us Price',
        ];
    }
}
