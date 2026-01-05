<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\User;
use common\models\Utilizador;

class DarPermissaoDeFormadorCest
{

    protected FunctionalTester $tester;

    // tests
    public function tentarDarPermissaoDeFormador(FunctionalTester $I)
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $I->assertTrue($idioma->save());

        $dificuldade = new Dificuldade();
        $dificuldade->grau_dificuldade = "Médio";
        $I->assertTrue($dificuldade->save());

        $user_admin = new User();
        $user_admin->username = "testesuser123";
        $user_admin->email = "usertest@gmail.com";
        $user_admin->setPassword("1234testeuser");
        $user_admin->generateAuthKey();
        $user_admin->status = User::STATUS_ACTIVE;
        $I->assertTrue($user_admin->save());

        $utilizador_admin = new Utilizador();
        $utilizador_admin->data_nascimento = '2026-01-03';
        $utilizador_admin->numero_telefone = 919999999;
        $utilizador_admin->nacionalidade = "Português";
        $utilizador_admin->data_inscricao = date('Y-m-d H:i:s');
        $utilizador_admin->user_id = $user_admin->id;
        $I->assertTrue($utilizador_admin->save());

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user_admin->getId());

        $user_formador = new User();
        $user_formador->username = "testesformador123";
        $user_formador->email = "userFormador@gmail.com";
        $user_formador->setPassword("1234testeformador");
        $user_formador->generateAuthKey();
        $user_formador->status = User::STATUS_ACTIVE;
        $I->assertTrue($user_formador->save());

        $utilizador_formador = new Utilizador();
        $utilizador_formador->data_nascimento = '2026-01-03';
        $utilizador_formador->numero_telefone = 919999999;
        $utilizador_formador->nacionalidade = "Português";
        $utilizador_formador->idioma_id = $idioma->id;
        $utilizador_formador->data_inscricao = date('Y-m-d H:i:s');
        $utilizador_formador->user_id = $user_formador->id;
        $I->assertTrue($utilizador_formador->save());

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('aluno');
        $auth->assign($authorRole, $user_formador->getId());


        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click('Sign In');

        $I->amOnPage('/user/formador');
        $I->see('Pendente');
        $I->click('Aceitar');
        $I->amOnPage('/user/formador');
        $I->see('Atribuído');


    }
}
