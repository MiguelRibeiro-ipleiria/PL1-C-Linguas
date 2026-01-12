<?php

namespace backend\modules\api\controllers;

use common\models\Aula;
use common\models\Curso;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;
use backend\modules\api\components\CustomAuth;
/**
 * Default controller for the `api` module
 */
class AulaController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Aula';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
            //'except' => ['index', 'view'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        /*NÃO EXISTEM AUTORIZAÇÕES PARA ESTE CONTROLADOR, PORQUE TODOS OS UTILIZADORES PODEM VER AS AULAS
        , OS SEUS COUNT, TIPOS DE EXERCICIOS, COUNT DOS MESMOS E EXERCICIOS DA AULA*/
    }

    public function actionDetalhesdaaula($id){

        $AulaModel = new $this->modelClass;
        $aula = $AulaModel::findOne($id);

        if($aula){

            $aula_allcontent = $AulaModel::find()
                ->where(['id' => $id])
                ->with(['curso.idioma'])
                ->one();

            $aulas_detalhes = [
                'id' => $aula_allcontent['id'],
                'titulo_aula' => $aula_allcontent['titulo_aula'],
                'descricao_aula' => $aula_allcontent['descricao_aula'],
                'numero_exercicios' => $aula_allcontent['numero_de_exercicios'],
                'tempo_estimado' => $aula_allcontent['tempo_estimado'],
                'curso' => $aula_allcontent->curso->titulo_curso ?? null,
                'idioma' => $aula_allcontent->curso->idioma->lingua_descricao ?? null,
            ];

            return $aulas_detalhes;
        }
        else{
            return "Aula não encontrada";
        }

    }

    public function actionAulasporcurso($curso_id)
    {
        $AulaModel = new $this->modelClass;

        $curso = Curso::findOne($curso_id);
        if($curso){
            $aulas = $AulaModel::find()
                ->where(['curso_id' => $curso_id])
                ->with(['curso'])
                ->asArray()
                ->all();

            $aulas_do_curso = [];

            foreach ($aulas as $aula) {
                $aulas_do_curso[] = [
                    'id' => $aula['id'],
                    'titulo_aula' => $aula['titulo_aula'],
                    'descricao_aula' => $aula['descricao_aula'],
                    'numero_exercicios' => $aula['numero_de_exercicios'],
                    'tempo_estimado' => $aula['tempo_estimado'],
                    'curso' => $aula['curso']['titulo_curso'] ?? null,
                ];
            }

            if($aulas_do_curso != []){
                return $aulas_do_curso;
            }
            else{
                throw new \yii\web\NotFoundHttpException("Aulas não encontradas");
            }
        }
        else{
            throw new \yii\web\NotFoundHttpException("Curso não encontrado");
        }

    }


    public function actionTipoexerciciosporaula($id)
    {
        $AulaModel = new $this->modelClass;
        $aula = $AulaModel::findOne($id);

        $exercicio_frase = 0;
        $exercicio_imagem = 0;
        $exercicio_audio = 0;

        if($aula){

            if($aula->getFrases()->count() > 0){
                $exercicio_frase = $aula->getFrases()->count();
            }

            if($aula->getImagems()->count() > 0){
                $exercicio_audio = $aula->getImagems()->count();
            }

            if($aula->getAudios()->count() > 0){
                $exercicio_imagem = $aula->getAudios()->count();
            }

            return [
                'exercicios_frases' => $exercicio_frase,
                'exercicios_audios' => $exercicio_audio,
                'exercicios_imagens' => $exercicio_imagem
            ];
        }
        else{
            throw new \yii\web\NotFoundHttpException("Aula não encontrada");
        }

    }


    public function actionAulaexecucaodeexerciciosaudios($id)
    {
        $modelClass = $this->modelClass;

        $aula = $modelClass::find()
            ->where(['id' => $id])
            ->with(['audios.audioResource', 'audios.opcoesais', 'audios.tipoexercicio'])
            ->one();

        if (!$aula) {
            return "Aula não encontrada";
        }

        $exercicios_audio = [];

        foreach ($aula->audios as $audio) {
            $resource = $audio->audioResource;

            $listaOpcoes = [];
            foreach ($audio->getOpcoesais()->all() as $opcao) {
                $listaOpcoes[] = [
                    'id' => $opcao->id,
                    'descricao' => $opcao->descricao,
                    'iscorrecta' => $opcao->iscorreta,
                ];
            }

            $exercicios_audio[] = [
                'tipo' => "Audio",
                'audio_resource_id' => $audio->audio_resource_id,
                'aula_id' => $aula->id,
                'pergunta' => $audio->pergunta,
                'nome_audio' => $resource->nome_audio,
                'nome_ficheiro' => $resource->nome_ficheiro,
                'opcoes' => $listaOpcoes,
            ];
        }

        if (empty($exercicios_audio)) {
            return "Sem exercicios de audio para realizar";
        }

        return $exercicios_audio;
    }

    public function actionAulaexecucaodeexerciciosfrases($id)
    {
        $modelClass = $this->modelClass;

        $aula = $modelClass::find()
            ->where(['id' => $id])
            ->with(['frases.opcoesais', 'frases.tipoexercicio'])
            ->one();

        if (!$aula) {
            return "Aula não encontrada";
        }

        $exercicios_frases = [];

        foreach ($aula->frases as $frase) {
            $listaOpcoes = [];
            foreach ($frase->getOpcoesais()->all() as $opcao) {
                $listaOpcoes[] = [
                    'id' => $opcao->id,
                    'descricao' => $opcao->descricao,
                    'iscorrecta' => $opcao->iscorreta,
                ];
            }

            $exercicios_frases[] = [
                'id' => $frase->id,
                'tipo' => "Frase",
                'aula_id' => $aula->id,
                'partefrases_1' => $frase->partefrases_1,
                'partefrases_2' => $frase->partefrases_2,
                'opcoes' => $listaOpcoes,
            ];
        }

        if (empty($exercicios_frases)) {
            return "Sem exercicios de frases para realizar";
        }

        return $exercicios_frases;
    }

    public function actionAulaexecucaodeexerciciosimagens($id)
    {
        $modelClass = $this->modelClass;

        $aula = $modelClass::find()
            ->where(['id' => $id])
            ->with(['imagems.imagemResource', 'imagems.opcoesais', 'imagems.tipoexercicio'])
            ->one();

        if (!$aula) {
            return "Aula não encontrada";
        }

        $exercicios_imagem = [];

        foreach ($aula->imagems as $imagem) {
            $resource = $imagem->imagemResource;

            $listaOpcoes = [];
            foreach ($imagem->getOpcoesais()->all() as $opcao) {
                $listaOpcoes[] = [
                    'id' => $opcao->id,
                    'descricao' => $opcao->descricao,
                    'iscorrecta' => $opcao->iscorreta,
                ];
            }

            $exercicios_imagem[] = [
                'tipo' => "Imagem",
                'imagem_resource_id' => $imagem->imagem_resource_id,
                'aula_id' => $aula->id,
                'pergunta' => $imagem->pergunta,
                'nome_imagem' => $resource->nome_imagem,
                'nome_ficheiro' => $resource->nome_ficheiro,
                'opcoes' => $listaOpcoes,
            ];
        }

        if (empty($exercicios_imagem)) {
            return "Sem exercicios de imagem para realizar";
        }

        return $exercicios_imagem;
    }







}
