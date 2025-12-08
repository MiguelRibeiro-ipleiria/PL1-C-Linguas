<?php

namespace backend\modules\api\controllers;

use yii\rest\Controller;
use yii\web\Response;
use common\models\User;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $body = \Yii::$app->request->post();

        $user = User::findByUsername($body['username'] ?? null);

        if (!$user || !$user->validatePassword($body['password'] ?? '')) {
            return ['status' => 'error', 'message' => 'Invalid credentials'];
        }

        //quem protege este controller e actions
        //ou nao gera um token ou gera e salva (perguntar ao stor)
        $user->generateAuthKey();

        return [
            'status' => 'success',
            'access_token' => $user->auth_key,
            'user_id' => $user->id
        ];
    }
}