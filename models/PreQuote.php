<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qt_pre_quote".
 *
 * @property integer $id
 * @property double $staffTraining
 * @property double $goLive
 * @property double $learning
 * @property double $itTraining
 *
 * @property QtPreQuoteClient[] $qtPreQuoteClients
 */
class PreQuote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qt_pre_quote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staffTraining', 'goLive', 'itTraining'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staffTraining' => 'Staff Training',
            'goLive' => 'Go Live',
            'itTraining' => 'It Training',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQtPreQuoteClients()
    {
        return $this->hasMany(QtPreQuoteClient::className(), ['qt_pre_quote_id' => 'id']);
    }
}
