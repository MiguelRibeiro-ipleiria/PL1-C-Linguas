<?php


namespace common\tests\Unit\models;

use common\models\Curso;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\User;
use common\models\Utilizador;
use common\tests\UnitTester;

class VerificaInscricaoUtilizadorTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testVerificainscricaoinvalida()
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

        //Apenas o cursos e o utilizador estão criados, a inscrição nunca é feita!

        $resultado = Inscricao::verificainscricao($curso->id, $utilizador->id);
        $this->assertFalse($resultado);
    }

    public function testVerificainscricaovalida()
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

        $resultado = Inscricao::verificainscricao($curso->id, $utilizador->id);
        $this->assertTrue($resultado);

    }
}
