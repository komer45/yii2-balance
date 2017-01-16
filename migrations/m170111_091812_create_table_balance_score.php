<?php

use yii\db\Schema;
use yii\db\Migration;

class m170111_091812_create_table_balance_score extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
             $this->createTable('{{%balance_score}}',[
               'id'=> $this->primaryKey(11),
               'user_id'=> $this->integer(11)->notNull(),
			   'balance'=> $this->float(12,2)->notNull(),
            ], $tableOptions);
    }

    public function safeDown()
    {

            $this->dropTable('{{%balance_score}}');
            $transaction->commit();

    }
}
