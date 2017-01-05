<?php

namespace komer45\balance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use komer45\balance\models\Score;

/**
 * SearchScore represents the model behind the search form about `komer45\balance\models\Score`.
 */
class SearchScore extends Score
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['balance'], 'number'],
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
        $query = Score::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'balance' => $this->balance,
        ]);

        return $dataProvider;
    }
}
