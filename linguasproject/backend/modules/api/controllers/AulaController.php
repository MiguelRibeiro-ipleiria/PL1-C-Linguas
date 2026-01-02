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
            'except' => ['index', 'view'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
//        if(isset(\Yii::$app->params['id'])){
//            if($action === "delete"){
//                if (!Yii::$app->user->can('DeleteLanguage')) {
//                    if($action === "delete"){
//                        throw new \yii\web\ForbiddenHttpException('Proibido');
//                    }
//                }
//
//            }
//        }
//        if(isset(\Yii::$app->params['id'])){
//
//            if(\Yii::$app->params['id'])
//            {
//                if($action === "delete"){
//                    throw new \yii\web\ForbiddenHttpException('Proibido');
//                }
//            }
//        }
        // Bloquear DELETE se não tiver permissão


    }

    public function actionCount()
    {
        $CursosModel = new $this->modelClass;
        $cursos = $CursosModel::find()->all();
        return ['count' => count($cursos)];
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

            if($aula->getCountFraseExercicios($aula->id) != null){
                $exercicio_frase = $aula->getCountFraseExercicios($aula->id);
            }

            if($aula->getCountAudioExercicios($aula->id) != null){
                $exercicio_audio = $aula->getCountAudioExercicios($aula->id);
            }

            if($aula->getCountImageExercicios($aula->id) != null){
                $exercicio_imagem = $aula->getCountImageExercicios($aula->id);
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


}
