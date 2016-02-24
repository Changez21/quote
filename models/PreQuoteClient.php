<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qt_pre_quote_client".
 *
 * @property integer $id
 * @property integer $qt_pre_quote_id
 * @property string $software
 * @property string $clientType
 * @property double $canadaPrice
 * @property integer $quantity
 * @property double $cost
 * @property double $workflow
 * @property string $formula
 * @property double $labor
 * @property integer $locations
 * @property string $notes
 * @property double $learning
 * @property double $usPrice
 * @property double $configuration
 * @property double $custom
 *
 * @property QtPreQuote $qtPreQuote
 */
class PreQuoteClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qt_pre_quote_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qt_pre_quote_id', 'quantity', 'locations'], 'integer'],
            [['client_type', 'notes'], 'string'],
            [['canadaPrice', 'cost', 'workflow', 'labor', 'learning', 'usPrice','configuration','custom'], 'number'],
            [['software'], 'string', 'max' => 45],
            [['formula'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qt_pre_quote_id' => 'Qt Pre Quote ID',
            'software' => 'Software',
            'client_type' => 'Client Type',
            'canadaPrice' => 'Canada Price',
            'quantity' => 'Quantity',
            'cost' => 'Cost',
            'workflow' => 'Workflow',
            'formula' => 'Formula',
            'labor' => 'Labor',
            'locations' => 'Locations',
            'notes' => 'Notes',
            'learning' => 'Learning',
            'usPrice' => 'Us Price',
            'configuration' => 'Configuration',
            'custom' => 'Custom',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQtPreQuote()
    {
        return $this->hasOne(QtPreQuote::className(), ['id' => 'qt_pre_quote_id']);
    }
}
