<?php

use yii\db\Migration;

class m170209_111941_create_scores_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%scores}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'player1' => $this->string(),
            'score1' => $this->string(),
            'win_player1' => $this->integer(),
            'player2' => $this->string(),
            'score2' => $this->string(),
            'win_player2' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-score-user_id', '{{%scores}}', 'user_id');

        $this->addForeignKey('fk-post-user_id', '{{%scores}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%scores}}');
    }
}
