<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scores_rank".
 *
 * @property int $id
 * @property int $user_id
 * @property string $player_name
 * @property string $score
 * @property int $wins
 */
class ScoresRank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scores_rank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'wins'], 'default', 'value' => null],
            [['user_id', 'wins','score'], 'integer'],
            [['player_name'], 'string', 'max' => 255],
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
            'player_name' => 'Player Name',
            'score' => 'Score',
            'wins' => 'Wins',
        ];
    }
}
