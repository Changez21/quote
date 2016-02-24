<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['software', 'client_type'], 'safe'],
            [['canada_price', 'us_price', 'configuration', 'learning', 'workflow', 'customization'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'canada_price' => $this->canada_price,
            'us_price' => $this->us_price,
            'configuration' => $this->configuration,
            'learning' => $this->learning,
            'workflow' => $this->workflow,
            'customization' => $this->customization,
        ]);

        $query->andFilterWhere(['like', 'software', $this->software])
            ->andFilterWhere(['like', 'client_type', $this->client_type]);

        return $dataProvider;
    }
}
