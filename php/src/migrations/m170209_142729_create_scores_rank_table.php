<?php

use yii\db\Migration;

class m170209_142729_create_scores_rank_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%scores_rank}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'player_name' => $this->string(),
            'score' => $this->integer(),
            'wins' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-score-rank-user_id', '{{%scores}}', 'user_id');

        $this->addForeignKey('fk-score-rank--user_id', '{{%scores}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%scores}}');
    }
}
