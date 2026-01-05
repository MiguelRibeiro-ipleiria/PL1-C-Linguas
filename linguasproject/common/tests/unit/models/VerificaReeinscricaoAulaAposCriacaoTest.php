<?php


namespace common\tests\Unit\models;

use common\models\Aula;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\Resultado;
use common\models\User;
use common\models\Utilizador;
use common\tests\UnitTester;

class VerificaReeinscricaoAulaAposCriacaoTest extends \Codeception\Test\Unit
{

    /* APÓS A CRIACAO DE UMA AULA, SE ALGUM UTILIZADOR ESTIVER INSCRITO NO CURSO DESSA AULA, A MESMA PRECISARÁ
    DE SER REGISTADA NA TABELA "RESULTADO" E O ESTADO DA "INSCRICAO" DEVIDAMENTE ALTERADO. (CASO O ALUNO JA
    TENHA ACABADO O CURSO, AO SER ADICIONADA MAIS UMA AULA A INSCRICÃO NÃO ESTÁ "CONCLUÍDA"). */

    /* ESTE "METODO" DE LÓGICA DE NEGÓCIO SÓ RETORNA FALSE CASO EXISTE ALGUM ERRO A GUARDAR O REGISTO */

    /* PORÉM EXISTEM 2 CENÁRIOS DE VALIDAÇÃO DE "TRUE", CASO NÃO ESTEJA NINGUEM INSCRITO NO CURSO E CASO ESTEJA
    ALGUÉM INSCRITO NO CURSO. SÃO ESSES 2 CENÁRIOS QUE TESTAMOS */

    protected UnitTester $tester;

    public function testVerificaReeinscricaoValidaSemInscricoesNoCurso()
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $this->assertTrue($idioma->save());

        $dificuldade = new Dificuldade();
        $dificuldade->grau_dificuldade = "Médio";
        $this->assertTrue($dificuldade->save());

        $user = new User();
        $user->username = "testesuser123";
        $user->email = "usertest@gmail.com";
        $user->setPassword("1234testeuser");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $utilizador = new Utilizador();
        $utilizador->data_nascimento = 03/01/2026;
        $utilizador->numero_telefone = 919999999;
        $utilizador->nacionalidade = "Português";
        $utilizador->idioma_id = $idioma->id;
        $utilizador->data_inscricao = date('Y-m-d H:i:s');
        $user->status = User::STATUS_ACTIVE;
        $this->assertTrue($user->save());
        $utilizador->user_id = $user->id;
        $this->assertTrue($utilizador->save());

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $this->assertTrue($curso->save());

        $aula = new Aula();
        $aula->titulo_aula = "Presente do Indicativo";
        $aula->descricao_aula = "Expressa uma ação no momento presente, hábitos, verdades universais!";
        $aula->numero_de_exercicios = 4;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "120min";
        $aula->utilizador_id = $utilizador->id;
        $this->assertTrue($aula->save());

        /*O que está a acontecer é que a aula está a ser criada, porém não existe nenhuma inscrição registada
        com o curso da aula que está a ser criada. Retorna TRUE! */

            $resultado = Resultado::ReeinscreverUtilizadoresEmAulas($aula->id);
            $this->assertTrue($resultado);
        }

    public function testVerificaReeinscricaoValidaComInscricoesNoCurso()
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $this->assertTrue($idioma->save());

        $dificuldade = new Dificuldade();
        $dificuldade->grau_dificuldade = "Médio";
        $this->assertTrue($dificuldade->save());

        $user = new User();
        $user->username = "testesuser123";
        $user->email = "usertest@gmail.com";
        $user->setPassword("1234testeuser");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $utilizador = new Utilizador();
        $utilizador->data_nascimento = 03/01/2026;
        $utilizador->numero_telefone = 919999999;
        $utilizador->nacionalidade = "Português";
        $utilizador->idioma_id = $idioma->id;
        $utilizador->data_inscricao = date('Y-m-d H:i:s');
        $user->status = User::STATUS_ACTIVE;
        $this->assertTrue($user->save());
        $utilizador->user_id = $user->id;
        $this->assertTrue($utilizador->save());

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $this->assertTrue($curso->save());

        $inscricao = new Inscricao();
        $inscricao->curso_idcurso = $curso->id;
        $inscricao->utilizador_id = $utilizador->id;
        $inscricao->data_inscricao = date('Y-m-d H:i:s');
        $inscricao->progresso = 0;
        $inscricao->estado = "Inscrito";
        $this->assertTrue($inscricao->save());

        $aula = new Aula();
        $aula->titulo_aula = "Presente do Indicativo";
        $aula->descricao_aula = "Expressa uma ação no momento presente, hábitos, verdades universais!";
        $aula->numero_de_exercicios = 4;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "120min";
        $aula->utilizador_id = $utilizador->id;
        $this->assertTrue($aula->save());

        /*O que está a acontecer é que a aula está a ser criada, porém não existe nenhuma inscrição registada
        com o curso da aula que está a ser criada. Retorna TRUE! */

        $resultado = Resultado::ReeinscreverUtilizadoresEmAulas($aula->id);
        $this->assertTrue($resultado);
    }

    public function testReeinscricaoFalhaComAulaInexistente()
    {
        //Testar o metodo com o parametro COM UM ID INEXISTENTE
        $resultado = Resultado::ReeinscreverUtilizadoresEmAulas(999);
        $this->assertFalse($resultado);
    }

    public function testReeinscricaoFalhaComParametroNulo()
    {
        //Testar o metodo com o parametro NULL
        $resultado = Resultado::ReeinscreverUtilizadoresEmAulas(null);
        $this->assertFalse($resultado);
    }
}
