<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qt_client".
 *
 * @property integer $id
 * @property string $software
 * @property string $client_type
 * @property double $canada_price
 * @property double $us_price
 * @property double $configuration
 * @property double $learning
 * @property double $workflow
 * @property double $customization
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qt_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['software', 'client_type', 'canada_price', 'us_price', 'configuration', 'learning', 'workflow', 'customization'], 'required'],
            [['client_type'], 'string'],
            [['canada_price', 'us_price', 'configuration', 'learning', 'workflow', 'customization'], 'number'],
            [['software'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'software' => 'Software',
            'client_type' => 'Client Type',
            'canada_price' => 'Canada Price',
            'us_price' => 'Us Price',
            'configuration' => 'Configuration',
            'learning' => 'Learning',
            'workflow' => 'Workflow',
            'customization' => 'Customization',
        ];
    }
    public function beforeAction($action){
        $this->enableCsrfValidation=false;
    }
}
