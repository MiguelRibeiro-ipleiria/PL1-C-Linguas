<?php


namespace frontend\tests\Functional;

use common\models\Aula;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Inscricao;
use frontend\tests\FunctionalTester;
use common\models\Comentario;
use common\models\Idioma;
use common\models\User;
use common\models\Utilizador;

class CriarComentarioNaAulaCest
{

    protected FunctionalTester $tester;
    public function tentarComentarNumaAula(FunctionalTester $I)
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

        $p1 = $auth->getPermission('SearchLanguage');
        $auth->assign($p1, $user->getId());

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $I->assertTrue($curso->save());

        $aula = new Aula();
        $aula->titulo_aula = "Pretérito Perfeito";
        $aula->descricao_aula = "Tempo verbal do passado que indica uma ação concluída num momento específico";
        $aula->numero_de_exercicios = 2;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "90min";
        $aula->utilizador_id = $utilizador->id;
        $I->assertTrue($aula->save());

        $inscricao = new Inscricao();
        $inscricao->curso_idcurso = $curso->id;
        $inscricao->utilizador_id = $utilizador->id;
        $inscricao->data_inscricao = date('Y-m-d H:i:s');
        $inscricao->progresso = 0;
        $inscricao->estado = "Inscrito";
        $I->assertTrue($inscricao->save());


        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click(['name' => 'login-button']);

        $I->amOnPage('/site/index');
        $I->amOnPage('/idioma/index');
        $I->see('As Nossas Línguas');
        $I->click('.single-service-link');

        $I->amOnPage('/curso/idiomacursos?id=' . $idioma->id);
        $I->see($curso->titulo_curso);
        $I->click('.styliesh');

        $I->amOnPage('/curso/aulas?id=' . $curso->id);
        $I->see($aula->titulo_aula);
        $I->click('.styliesh');

        $I->amOnPage('/aula/view?id=' . $aula->id);
        $I->see('Comentários');
        $I->fillField('Comentario[descricao_comentario]', 'O percurso completo funcionou!');
        $I->click('Enviar Comentário');
        $I->see('O percurso completo funcionou!');

    }
}
