<?php


namespace frontend\tests\Functional;

use common\models\Aula;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Frase;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\Opcoesai;
use common\models\Resultado;
use common\models\Tipoexercicio;
use common\models\User;
use common\models\Utilizador;
use frontend\tests\FunctionalTester;

class ResponderAUmaAulaCest
{

    protected FunctionalTester $tester;

    public function tentarParticiparEResponderAUmaAula(FunctionalTester $I)
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
        $aula->numero_de_exercicios = 1;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "90min";
        $aula->utilizador_id = $utilizador->id;
        $I->assertTrue($aula->save());

        $tipo_exercicio = new TipoExercicio();
        $tipo_exercicio->descricao = "Exercícios Frases";
        $I->assertTrue($tipo_exercicio->save());

        $frase = new Frase();
        $frase->partefrases_1 = "O João ";
        $frase->partefrases_2 = " ao shopping, ontem!";
        $frase->aula_id = $aula->id;
        $frase->tipoexercicio_id = $tipo_exercicio->id;
        $I->assertTrue($frase->save());

        $opcao_1_frase = new Opcoesai();
        $opcao_1_frase->frase_id = $frase->id;
        $opcao_1_frase->iscorreta = 1;
        $opcao_1_frase->descricao = "foi";
        $I->assertTrue($opcao_1_frase->save());

        $opcao_2_frase = new Opcoesai();
        $opcao_2_frase->frase_id = $frase->id;
        $opcao_2_frase->iscorreta = 0;
        $opcao_2_frase->descricao = "vai";
        $I->assertTrue($opcao_2_frase->save());

        $opcao_3_frase = new Opcoesai();
        $opcao_3_frase->frase_id = $frase->id;
        $opcao_3_frase->iscorreta = 0;
        $opcao_3_frase->descricao = "irá";
        $I->assertTrue($opcao_3_frase->save());

        $opcao_4_frase = new Opcoesai();
        $opcao_4_frase->frase_id = $frase->id;
        $opcao_4_frase->iscorreta = 0;
        $opcao_4_frase->descricao = "foram";
        $I->assertTrue($opcao_4_frase->save());

        $inscricao = new Inscricao();
        $inscricao->curso_idcurso = $curso->id;
        $inscricao->utilizador_id = $utilizador->id;
        $inscricao->data_inscricao = date('Y-m-d H:i:s');
        $inscricao->progresso = 0;
        $inscricao->estado = "Inscrito";
        $I->assertTrue($inscricao->save());

        $resultado = new Resultado();
        $resultado->estado = "Por Começar";
        $resultado->utilizador_id = $utilizador->id;
        $resultado->aula_idaula = $aula->id;
        $I->assertTrue($resultado->save());


        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'testesuser123');
        $I->fillField('LoginForm[password]', '1234testeuser');
        $I->click(['name' => 'login-button']);

// 1. Ir para a lista de idiomas
        $I->amOnPage('/idioma/index');
        $I->see('As Nossas Línguas');
        $I->click('Português');

// 2. Na página IDIOMA_CURSO (Onde aparecem os cards dos cursos)
// Em vez de .styliesh, clica no ícone de seta (bi-arrow-right) ou no título do curso
        $I->see($curso->titulo_curso);
// Como o link para aulas está num <a> com a classe .styliesh ao lado do botão desinscrever
        $I->click('.bi-arrow-right');

// 3. Na página CURSOS_AULAS (A que corresponde à tua imagem)
        $I->see($aula->titulo_aula);
// IMPORTANTE: Usa o texto exato do teu PHP: "Ver aula"
        $I->click('Ver aula');

// --- INTERAÇÃO NA VIEW DA AULA ---
        $I->seeInCurrentUrl('/aula/view');

// Abrir o Dialog de início
        $I->click('#open_start_aula');
        $I->see('Deseja começar a Aula?', '#title_start_aula');

// Confirmar o início (Botão Sim)
        $I->click('#confirm_start_aula');

// --- EXECUÇÃO DO EXERCÍCIO ---
        $I->see('Completa a Frase', '.title-exercicio-audio');
        $I->click('foi'); // Opção correta configurada no setup
        $I->seeElement('.opcao_layout_green');

// Avançar e Concluir
        $I->click('Seguinte');
        $I->see('Concluir');
        $I->click('Concluir');


        $I->amOnPage('/aula/view?id=' . $aula->id);


    }
}
