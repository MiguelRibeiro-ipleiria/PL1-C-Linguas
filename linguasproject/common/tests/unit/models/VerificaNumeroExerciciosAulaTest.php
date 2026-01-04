<?php


namespace common\tests\Unit\models;

use common\models\Frase;
use common\models\Opcoesai;
use common\models\Tipoexercicio;
use common\tests\UnitTester;
use common\models\Curso;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Inscricao;
use common\models\User;
use common\models\Aula;
use common\models\Utilizador;

class VerificaNumeroExerciciosAulaTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    public function testVerificaNumeroIncorretoExerciciosAula()
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

        $aula = new Aula();
        $aula->titulo_aula = "Pretérito Perfeito";
        $aula->descricao_aula = "Tempo verbal do passado que indica uma ação concluída num momento específico";
        $aula->numero_de_exercicios = 0;
        $aula->data_criacao = date('Y-m-d H:i:s');
        $aula->curso_id = $curso->id;
        $aula->tempo_estimado = "90min";
        $aula->utilizador_id = $utilizador->id;
        $aula->save();

        $tipo_exercicio = new TipoExercicio();
        $tipo_exercicio->descricao = "Exercícios Frases";
        $tipo_exercicio->save();

        $frase_um = new Frase();
        $frase_um->partefrases_1 = "O João ";
        $frase_um->partefrases_2 = " ao shopping, ontem!";
        $frase_um->aula_id = $aula->id;
        $frase_um->tipoexercicio_id = $tipo_exercicio->id;
        $frase_um->save();

        $opcao_1_frase_um = new Opcoesai();
        $opcao_1_frase_um->frase_id = $frase_um->id;
        $opcao_1_frase_um->iscorreta = 1;
        $opcao_1_frase_um->descricao = "foi";
        $opcao_1_frase_um->save();

        $opcao_2_frase_um = new Opcoesai();
        $opcao_2_frase_um->frase_id = $frase_um->id;
        $opcao_2_frase_um->iscorreta = 0;
        $opcao_2_frase_um->descricao = "vai";
        $opcao_2_frase_um->save();

        $opcao_3_frase_um = new Opcoesai();
        $opcao_3_frase_um->frase_id = $frase_um->id;
        $opcao_3_frase_um->iscorreta = 0;
        $opcao_3_frase_um->descricao = "irá";
        $opcao_3_frase_um->save();

        $opcao_4_frase_um = new Opcoesai();
        $opcao_4_frase_um->frase_id = $frase_um->id;
        $opcao_4_frase_um->iscorreta = 0;
        $opcao_4_frase_um->descricao = "foram";
        $opcao_4_frase_um->save();

        $frase_dois = new Frase();
        $frase_dois->partefrases_1 = "O Ricardo ";
        $frase_dois->partefrases_2 = " ao shopping, amanhã!";
        $frase_dois->aula_id = $aula->id;
        $frase_dois->tipoexercicio_id = $tipo_exercicio->id;
        $frase_dois->save();

        $opcao_1_frase_dois = new Opcoesai();
        $opcao_1_frase_dois->frase_id = $frase_dois->id;
        $opcao_1_frase_dois->iscorreta = 0;
        $opcao_1_frase_dois->descricao = "foi";
        $opcao_1_frase_dois->save();

        $opcao_2_frase_dois = new Opcoesai();
        $opcao_2_frase_dois->frase_id = $frase_dois->id;
        $opcao_2_frase_dois->iscorreta = 0;
        $opcao_2_frase_dois->descricao = "vai";
        $opcao_2_frase_dois->save();

        $opcao_3_frase_dois = new Opcoesai();
        $opcao_3_frase_dois->frase_id = $frase_dois->id;
        $opcao_3_frase_dois->iscorreta = 1;
        $opcao_3_frase_dois->descricao = "irá";
        $opcao_3_frase_dois->save();

        $opcao_4_frase_dois = new Opcoesai();
        $opcao_4_frase_dois->frase_id = $frase_dois->id;
        $opcao_4_frase_dois->iscorreta = 0;
        $opcao_4_frase_dois->descricao = "foram";
        $opcao_4_frase_dois->save();

        /*Acima foram criados dois exercícios, portanto o valor esperado de retorno da função que verifica deve ser "2"*/

        $resultado = $aula->VerificaNumeroDeExercicios($aula->id);
        $this->assertSame(2, $resultado);

    }
}
