<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scores".
 *
 * @property int $id
 * @property int $user_id
 * @property string player1
 * @property string $score1
 * @property int $win_player1
 * @property string player2
 * @property string $score2
 * @property int $win_player2
 *
 * @property User $user
 */
class Scores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'win_player1', 'win_player2'], 'default', 'value' => null],
            [['user_id','win_player1', 'win_player2','score1','score2'], 'integer'],
            [['player1','player2'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'player1' => 'Player1',
            'score1' => 'Score1',
            'win_player1' => 'Win Player1',
            'player2' => 'Player2',
            'score2' => 'Score2',
            'win_player2' => 'Win Player2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
