<?php

namespace komer45\balance\models;

use Yii;

/**
 * This is the model class for table "balance_transaction".
 *
 * @property integer $id
 * @property integer $balance_id
 * @property string $date
 * @property string $type
 * @property string $amount
 * @property string $balance
 * @property integer $user_id
 * @property string $refill_type
 * @property string $canceled
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance_id', 'type', 'amount', 'refill_type'], 'required'],
            [['balance_id', 'user_id'], 'integer'],
            [['date', 'canceled'], 'safe'],
            [['type'], 'string'],
            [['amount', 'balance'], 'number'],
            [['refill_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'balance_id' => 'ID кошелька',
            'date' => 'Дата создания транзакции',
            'type' => 'Тип транзакции',
            'amount' => 'Кол-во средств',
            'balance' => 'Остаток',
            'user_id' => 'ID пользователя',
            'refill_type' => 'Тип пополнения',
            'canceled' => 'Дата отмены транзакции ',
        ];
    }
}
