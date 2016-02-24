<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ThirdParty;

/**
 * ThirdPartySearch represents the model behind the search form about `app\models\ThirdParty`.
 */
class ThirdPartySearch extends ThirdParty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hardware'], 'safe'],
            [['canadaPrice', 'usPrice'], 'number'],
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
        $query = ThirdParty::find();

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
            'canadaPrice' => $this->canadaPrice,
            'usPrice' => $this->usPrice,
        ]);

        $query->andFilterWhere(['like', 'hardware', $this->hardware]);

        return $dataProvider;
    }
}
