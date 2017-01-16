<?php

use yii\db\Schema;
use yii\db\Migration;

class m170111_091812_create_table_balance_transaction extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

             $this->createTable('{{%balance_transaction}}',[
               'id' => $this->primaryKey(11),
			   'balance_id' => $this->integer(11)->notNull(),
			   'date' => $this->datetime()->null()->defaultValue(null),
			   'type' => "ENUM('in', 'out') NOT NULL",
			   'amount' => $this->decimal(12, 2)->notNull(),
			   'balance' => $this->decimal(12, 2)->notNull(),
			   'user_id'=> $this->integer(11)->notNull(),
			   'refill_type' => $this->string(255)->notNull(),
               'canceled' => $this->datetime()->null()->defaultValue(null),
			   'comment' => $this->string(255)->null()->defaultValue(null),
            ], $tableOptions);

    }

    public function safeDown()
    {

            $this->dropTable('{{%balance_transaction}}');
            $transaction->commit();

    }
}
