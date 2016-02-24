<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PreQuoteClient;

/**
 * PreQuoteClientSearch represents the model behind the search form about `app\models\PreQuoteClient`.
 */
class PreQuoteClientSearch extends PreQuoteClient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qt_pre_quote_id', 'quantity', 'locations'], 'integer'],
            [['software', 'clientType', 'formula', 'notes'], 'safe'],
            [['canadaPrice', 'cost', 'workflow', 'labor', 'learning', 'usPrice','configuration','custom'], 'number'],
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
        $query = PreQuoteClient::find();

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
            'qt_pre_quote_id' => $this->qt_pre_quote_id,
            'canadaPrice' => $this->canadaPrice,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'workflow' => $this->workflow,
            'labor' => $this->labor,
            'locations' => $this->locations,
            'learning' => $this->learning,
            'usPrice' => $this->usPrice,
            'configuration' => $this->configuration,
            'custom' => $this->custom,
        ]);

        $query->andFilterWhere(['like', 'software', $this->software])
            ->andFilterWhere(['like', 'clientType', $this->clientType])
            ->andFilterWhere(['like', 'formula', $this->formula])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
