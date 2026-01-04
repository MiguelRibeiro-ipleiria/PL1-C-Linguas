<?php


namespace common\tests\Unit\models;

use common\models\Curso;
use common\models\Dificuldade;
use common\models\Aula;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\Resultado;
use common\models\User;
use common\models\Utilizador;
use common\tests\UnitTester;

class VerificaEstadoTerminadoCursoTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    /* O ESTADO DO CURSO (NA INSCRICAO DO UTILIZADOR ) É ALTERADO E CONSIDERADO "CONCLUÍDO" QUANDO TODAS
    AS AULAS RESPETIVAS AO CURSO NA TABELA "RESULTADOS" (RESULTADOS DO UTILIZADOR) ESTÃO COM O ESTADO
    "TERMINADA", É ISSO QUE A FUNÇÃO EM TESTE VERIFICA */

    public function testVerificaEstadoDoCursoIncompleto()
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $idioma->save();

        $dificuldade = new Dificuldade();
        $dificuldade->grau_dificuldade = "Médio";
        $dificuldade->save();

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
        $user->save();
        $utilizador->user_id = $user->id;
        $utilizador->save();

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $curso->save();

        $aula_um = new Aula();
        $aula_um->titulo_aula = "Pretérito Perfeito";
        $aula_um->descricao_aula = "Tempo verbal do passado que indica uma ação concluída num momento específico";
        $aula_um->numero_de_exercicios = 2;
        $aula_um->data_criacao = date('Y-m-d H:i:s');
        $aula_um->curso_id = $curso->id;
        $aula_um->tempo_estimado = "90min";
        $aula_um->save();

        $aula_dois = new Aula();
        $aula_dois->titulo_aula = "Presente do Indicativo";
        $aula_dois->descricao_aula = "Expressa uma ação no momento presente, hábitos, verdades universais!";
        $aula_dois->numero_de_exercicios = 4;
        $aula_dois->data_criacao = date('Y-m-d H:i:s');
        $aula_dois->curso_id = $curso->id;
        $aula_dois->tempo_estimado = "120min";
        $aula_dois->save();

        $inscricao = new Inscricao();
        $inscricao->curso_idcurso = $curso->id;
        $inscricao->utilizador_id = $utilizador->id;
        $inscricao->data_inscricao = date('Y-m-d H:i:s');
        $inscricao->progresso = 0;
        $inscricao->estado = "Inscrito";
        $inscricao->save();

        $resultado_um = new Resultado();
        $resultado_um->estado = "Terminada";
        $resultado_um->utilizador_id = $utilizador->id;
        $resultado_um->tempo_estimado = 530; //(em segundos)
        $resultado_um->aula_idaula = $aula_um->id;
        $resultado_um->respostas_certas = 1;
        $resultado_um->respostas_erradas = 1;
        $resultado_um->nota = 50;
        $resultado_um->data_inicio = "2026-01-03 19:57:47";
        $resultado_um->data_fim = "2026-01-03 19:57:52";
        $resultado_um->save();

        $resultado_dois = new Resultado();
        $resultado_dois->estado = "Por Começar";
        $resultado_dois->utilizador_id = $utilizador->id;
        $resultado_dois->aula_idaula = $aula_dois->id;
        $resultado_dois->save();


        /*Apenas existe uma aula que tem o estado "Terminada", ou seja, tende a devolver false porque nem todas
        as aulas desse curso inscrito estão terminadas*/

        $resultado = Inscricao::VerificaEstadoCurso($curso->id, $utilizador->id);
        $this->assertFalse($resultado);
    }

    public function testVerificaEstadoDoCursoTerminado()
    {
        $idioma = new Idioma();
        $idioma->lingua_descricao = "Português";
        $idioma->data_criacao = date("Y-m-d H:i:s");
        $idioma->lingua_objetivo = "Aprender Português";
        $idioma->lingua_bandeira = "Portugal.png";
        $idioma->lingua_sigla = "PT";
        $idioma->save();

        $dificuldade = new Dificuldade();
        $dificuldade->grau_dificuldade = "Médio";
        $dificuldade->save();

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
        $user->save();
        $utilizador->user_id = $user->id;
        $utilizador->save();

        $curso = new Curso();
        $curso->titulo_curso = "Curso de Português";
        $curso->curso_detalhe = "Curso sobre gramática";
        $curso->idioma_id = $idioma->id;
        $curso->data_criacao = date('Y-m-d H:i:s');
        $curso->dificuldade_id = $dificuldade->id;
        $curso->utilizador_id = $utilizador->id;
        $curso->status_ativo = 1;
        $curso->save();

        $aula_um = new Aula();
        $aula_um->titulo_aula = "Pretérito Perfeito";
        $aula_um->descricao_aula = "Tempo verbal do passado que indica uma ação concluída num momento específico";
        $aula_um->numero_de_exercicios = 2;
        $aula_um->data_criacao = date('Y-m-d H:i:s');
        $aula_um->curso_id = $curso->id;
        $aula_um->tempo_estimado = "90min";
        $aula_um->save();

        $aula_dois = new Aula();
        $aula_dois->titulo_aula = "Presente do Indicativo";
        $aula_dois->descricao_aula = "Expressa uma ação no momento presente, hábitos, verdades universais!";
        $aula_dois->numero_de_exercicios = 4;
        $aula_dois->data_criacao = date('Y-m-d H:i:s');
        $aula_dois->curso_id = $curso->id;
        $aula_dois->tempo_estimado = "120min";
        $aula_dois->save();

        $inscricao = new Inscricao();
        $inscricao->curso_idcurso = $curso->id;
        $inscricao->utilizador_id = $utilizador->id;
        $inscricao->data_inscricao = date('Y-m-d H:i:s');
        $inscricao->progresso = 0;
        $inscricao->estado = "Inscrito";
        $inscricao->save();

        $resultado_um = new Resultado();
        $resultado_um->estado = "Terminada";
        $resultado_um->utilizador_id = $utilizador->id;
        $resultado_um->tempo_estimado = 530; //(em segundos)
        $resultado_um->aula_idaula = $aula_um->id;
        $resultado_um->respostas_certas = 1;
        $resultado_um->respostas_erradas = 1;
        $resultado_um->nota = 50;
        $resultado_um->data_inicio = "2026-01-03 19:57:47";
        $resultado_um->data_fim = "2026-01-03 19:57:52";
        $resultado_um->save();

        $resultado_dois = new Resultado();
        $resultado_dois->estado = "Terminada";
        $resultado_dois->utilizador_id = $utilizador->id;
        $resultado_dois->tempo_estimado = 1230; //(em segundos)
        $resultado_dois->aula_idaula = $aula_dois->id;
        $resultado_dois->respostas_certas = 4;
        $resultado_dois->respostas_erradas = 0;
        $resultado_dois->nota = 100;
        $resultado_dois->data_inicio = "2026-01-03 19:59:47";
        $resultado_dois->data_fim = "2026-01-03 20:00:52";
        $resultado_dois->save();

        /*Agora existem dois aulas que tem o estado "Terminada", ou seja, tende a devolver true porque todas
        as aulas desse curso inscrito estão terminadas*/

        $resultado = Inscricao::VerificaEstadoCurso($curso->id, $utilizador->id);
        $this->assertTrue($resultado);
    }
}
