<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\Aula;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\Tipoexercicio;
use common\models\User;
use common\models\Utilizador;

class CriarExerciciosParaAulaCest
{

    protected FunctionalTester $tester;

    public function tentarCriarExerciciosNumaAula(\frontend\tests\FunctionalTester $I)
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
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $I->assertTrue($curso->save());

        $tipo_exercicio = new Tipoexercicio();
        $tipo_exercicio->descricao = "Frase";
        $I->assertTrue($tipo_exercicio->save());

        $aula = new Aula();
        $aula->titulo_aula = "Pretérito Perfeito";
        $aula->descricao_aula = "Tempo verbal do passado que indica uma ação concluída num momento específico";
        $aula->numero_de_exercicios = 2;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "90min";
        $aula->utilizador_id = $utilizador->id;
        $I->assertTrue($aula->save());

        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click('Sign In');

        $I->amOnPage('/aula/index');
        $I->see($aula->titulo_aula);
        $I->click('Adicionar Exercicio');

        $I->amOnPage('/aula/escolherexercicio?id=' . $aula->id);
        $I->see('Frases');
        $I->click('a[href*="frase"]');

        $I->amOnPage('/frase/create?aula_id=' . $aula->id);
        $I->fillField('Frase[partefrases_1]', 'O gato está');
        $I->fillField('Frase[partefrases_2]', 'no telhado.');
        $I->selectOption('Frase[tipoexercicio_id]', (string)$tipo_exercicio->id);

        $I->fillField('Opcoesai[0][descricao]', 'sentado');
        $I->checkOption('input[name="Opcoesai[0][iscorreta]"][type="checkbox"]');

        $I->fillField('Opcoesai[1][descricao]', 'a correr');
        $I->fillField('Opcoesai[2][descricao]', 'a saltar');
        $I->fillField('Opcoesai[3][descricao]', 'a dormir');

        $I->click('Save');
        $I->seeInCurrentUrl('/frase/view');
        $I->see('O gato está');

    }
}
