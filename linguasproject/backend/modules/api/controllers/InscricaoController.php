<?php

namespace backend\modules\api\controllers;

use common\models\Inscricao;
use common\models\User;
use common\models\Curso;
use common\models\Utilizador;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class InscricaoController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Inscricao';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCount()
    {
        $InscricaoModel = new $this->modelClass;
        $inscricoes = $InscricaoModel::find()->all();
        return ['count' => count($inscricoes)];
    }

    public function actionInscricao($id)
    {
        $InscricaoModel = new $this->modelClass;
        $inscricoes = Inscricao::find()->where(['id' => $id])->one();
        if($inscricoes != null) {
            return $inscricoes;
        }else{
            return "Inscrição não foi encontrada";
        }
    }


    public function actionCountporuser($usernome)
    {
        $InscricaoModel = new $this->modelClass;
        $user = User::find()->where(['username' => $usernome])->one();
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

        if($utilizador == null){
            return "Utilizador não encontrado!";
        }
        else{
            $inscricoes = $InscricaoModel::find()->where(['utilizador_id' => $utilizador->id])->all();
            return ['count' => count($inscricoes)];
        }

    }

    public function actionInscricoesporuser($usernome)
    {
        $InscricaoModel = new $this->modelClass;
        $user = User::find()->where(['username' => $usernome])->one();
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

        if($utilizador == null){
            return "Utilizador não encontrado!";
        }
        else{
            $inscricoes = $InscricaoModel::find()->where(['utilizador_id' => $utilizador->id])->all();
            return $inscricoes;
        }
    }

    public function actionIsinscrito($usernome, $id)
    {
        $InscricaoModel = new $this->modelClass;
        $user = User::find()->where(['username' => $usernome])->one();
        $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();
        $curso =  Curso::find()->where(['id' => $id])->one();

        if($utilizador == null || $curso == null){
            return "User ou Curso não encontrados!";
        }
        else{
            $inscricoes = $InscricaoModel::find()->where(['curso_idcurso' => $curso->id, 'utilizador_id' => $utilizador->id])->one();
            if($inscricoes != null){
                return true;
            }
            else{
                return false;
            }
        }
    }


}
