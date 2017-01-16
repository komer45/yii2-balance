<?php

namespace komer45\balance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use komer45\balance\models\Transaction;

/**
 * SearchTransaction represents the model behind the search form about `komer45\balance\models\Transaction`.
 */
class SearchTransaction extends Transaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'balance_id', 'user_id'], 'integer'],
            [['date', 'type', 'refill_type', 'canceled'], 'safe'],
            [['amount', 'balance'], 'number'],
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
        $query = Transaction::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'balance_id' => $this->balance_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'balance' => $this->balance,
            'user_id' => $this->user_id,
            'canceled' => $this->canceled,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'refill_type', $this->refill_type]);

        return $dataProvider;
    }
}
