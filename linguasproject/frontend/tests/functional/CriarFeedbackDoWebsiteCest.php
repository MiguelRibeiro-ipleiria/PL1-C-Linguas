<?php


namespace frontend\tests\Functional;

use common\models\Aula;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\User;
use common\models\Utilizador;
use frontend\tests\FunctionalTester;

class CriarFeedbackDoWebsiteCest
{

    protected FunctionalTester $tester;

    // tests
    public function tentarCriarUmFeedback(FunctionalTester $I)
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
        $authorRole = $auth->getRole('aluno');
        $auth->assign($authorRole, $user->getId());

        $p1 = $auth->getPermission('CreateFeedback');
        $auth->assign($p1, $user->getId());

        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click(['name' => 'login-button']);

        $I->amOnPage('/feedback/create');
        $I->see('feedback');
        $I->fillField('Feedback[assunto_feedback]', 'Sugestão de melhoria');
        $I->fillField('Feedback[descricao_feedback]', 'Gostaria de ver mais cursos de gramática avançada.');
        $I->click('Enviar Feedback');

        $I->amOnPage('/feedback/index');
        $I->see('Sugestão de melhoria');




    }
}
