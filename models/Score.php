<?php

namespace komer45\balance\models;

use Yii;

/**
 * This is the model class for table "balance_score".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $balance
 */
class Score extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'balance'], 'required'],
            [['user_id'], 'integer'],
            [['balance'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'balance' => 'Остаток',
        ];
    }
}
