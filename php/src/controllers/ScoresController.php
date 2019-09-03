<?php

namespace app\controllers;

use api\models\PostSearch;
use common\models\Post;
use common\rbac\Rbac;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;
use app\models\Scores;
use app\models\ScoresRank;

class ScoresController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class']=  CompositeAuth::className();
        $behaviors['authenticator']['authMethods'] = [
                     HttpBasicAuth::className(),
                     HttpBearerAuth::className(),
                     [
                              'class' => \yii\filters\auth\QueryParamAuth::className(),
                              'tokenParam' => 'token'
                      ]
                ];


        return $behaviors;
    }
    
     public function beforeAction($action)
    {
        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            // End it, otherwise a 401 will be shown.
            Yii::$app->end();
        }
        $this->enableCsrfValidation = false;
        parent::beforeAction($action);
        return true;
    }

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

    
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $scores = Scores::find()->where(['user_id'=>$user_id])->orderBy('id DESC')->all();
        return $scores;
    }
    
    public function actionRank()
    {
        $user_id = Yii::$app->user->id;
        $scores = ScoresRank::find()->where(['user_id'=>$user_id])->orderBy('score DESC')->all();
        return $scores;
    }
    
    public function actionAdd()
    {
        $user_id = Yii::$app->user->id;
        $model = new Scores;      
        $model->load(Yii::$app->request->bodyParams,'');
        if($model->validate() && $model->save()){
            $rank = ScoresRank::find()->where(['user_id'=>$user_id])->andWhere(  ['player_name'=>$model->player1])->one();
            if($rank){
                $rank->player_name = $model->player1;
                $rank->score = (int)$model->score1+(int)$rank->score;
                $rank->wins = (int)$model->win_player1+(int)$rank->wins;
            }else{
                $rank = new ScoresRank;
                $rank->player_name = $model->player1;
                $rank->score = $model->score1;
                $rank->wins = $model->win_player1;
                $rank->user_id = $user_id;
            }
            $rank->save();
            $rank = ScoresRank::find()->where(['user_id'=>$user_id])->andWhere(  ['player_name'=>$model->player2])->one();
            if($rank){
                $rank->player_name = $model->player2;
                $rank->score = (int)$model->score2+(int)$rank->score;
                $rank->wins = (int)$model->win_player2+(int)$rank->wins;
            }else{
                $rank = new ScoresRank;
                $rank->player_name = $model->player2;
                $rank->score = $model->score2;
                $rank->wins = $model->win_player2;
                $rank->user_id = $user_id;
            }
            
            $rank->save();
            
            return $model;
        }
        return $model->getErrors();
    }
 
}