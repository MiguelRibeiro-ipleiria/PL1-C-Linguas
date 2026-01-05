<?php

namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\User;
use common\models\Utilizador;
use common\models\Idioma;

class BackendLoginFunctionalCest
{
    public function tryLogin(FunctionalTester $I)
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $I->assertTrue($idioma->save());

        $user = new User();
        $user->username = "testesuser123";
        $user->email = "usertest@gmail.com";
        $user->setPassword("1234testeuser");
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $I->assertTrue($user->save());

        $utilizador = new Utilizador();
        $utilizador->data_nascimento = '2026-01-03';
        $utilizador->numero_telefone = 919999999;
        $utilizador->nacionalidade = "Português";
        $utilizador->idioma_id = $idioma->id;
        $utilizador->data_inscricao = date('Y-m-d H:i:s');
        $utilizador->user_id = $user->id;
        $I->assertTrue($utilizador->save());

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());

        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click('Sign In');

        $I->see('Sign out');
        $I->see('Painel de Gestão');
        $I->dontSee('Sign in to start your session');
    }
}