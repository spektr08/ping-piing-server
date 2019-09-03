<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use yii\filters\auth\CompositeAuth;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\filters\auth\QueryParamAuth;
use  app\models\SignupForm;
use app\models\User;


class SiteController extends Controller
{
    

    public function actionIndex()
    {
        return 'api';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
       
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return ['error'=>'Wrong credentials'];
        }
    }
    
    
    public function actionRegister(){
        $model = new SignupForm();
        $model->load(Yii::$app->request->bodyParams,'');
        if($model->validate()){
        $is_user =  User::find()->where(['username'=>$model->username])->one();
        if($is_user){
            return ['error'=>'Username name is already taken'];
        }
        $user = new User();
        $user->username = $model->username;
        $user->password = $model->password;
        $user->generateAuthKey();
            if($user->save()){
                return $user;
            }
         }
         
             return ['error'=>'Something wrong'];
         
    }

    protected function verbs()
    {
        return [
            'login' => ['post','options'],
            'register' => ['post','options'],           
        ];
    }
}

