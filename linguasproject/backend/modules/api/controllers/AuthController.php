<?php

namespace backend\modules\api\controllers;

use yii\rest\Controller; //CONTROLLER REST
use yii\web\Response;
use common\models\User;
use common\models\Utilizador;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $body = \Yii::$app->request->post();

        $user = User::findByUsername($body['username'] ?? null);

        if (!$user || !$user->validatePassword($body['password'] ?? '')) {
            return ['status' => 'error', 'message' => 'Invalid credentials'];
        }

        $utilizador = Utilizador::findOne(['user_id' => $user->id]);
        return [
            'status' => 'success',
            'access_token' => $user->auth_key,
            'utilizador_id' => $utilizador->id
        ];
    }
}