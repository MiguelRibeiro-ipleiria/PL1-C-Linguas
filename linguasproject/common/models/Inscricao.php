<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inscricao".
 *
 * @property int $utilizador_id
 * @property int $curso_idcurso
 * @property string $data_inscricao
 * @property int $progresso
 * @property string $estado
 *
 * @property Curso $cursoIdcurso
 * @property Utilizador $utilizador
 */
class Inscricao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inscricao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['utilizador_id', 'curso_idcurso', 'data_inscricao', 'progresso', 'estado'], 'required'],
            [['utilizador_id', 'curso_idcurso', 'progresso'], 'integer'],
            [['data_inscricao', 'estado'], 'string', 'max' => 45],
            [['utilizador_id', 'curso_idcurso'], 'unique', 'targetAttribute' => ['utilizador_id', 'curso_idcurso']],
            [['curso_idcurso'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::class, 'targetAttribute' => ['curso_idcurso' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['utilizador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'utilizador_id' => 'Utilizador ID',
            'curso_idcurso' => 'Curso Idcurso',
            'data_inscricao' => 'Data Inscricao',
            'progresso' => 'Progresso',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[CursoIdcurso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoIdcurso()
    {
        return $this->hasOne(Curso::class, ['id' => 'curso_idcurso']);
    }

    public function getCurso(){
        $curso = Curso::findOne($this->curso_idcurso);
        return $curso;
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id' => 'utilizador_id']);
    }


    public static function verificainscricao($curso_id, $utilizador_id){

        $inscricao = Inscricao::find()->where(['curso_idcurso' => $curso_id, 'utilizador_id' => $utilizador_id])->all();

        if($inscricao == null){
            return true;
        }
        else{
            return false;
        }
    }

    public static function inscricaonasaulas($curso_id, $utilizador_id){

        $aulas = Aula::find()->where(['curso_id' => $curso_id])->all();


        if($aulas != null){
            foreach ($aulas as $aula){

                $model_resultado = new Resultado();
                $model_resultado->utilizador_id = $utilizador_id;
                $model_resultado->aula_idaula = $aula->id;
                $model_resultado->estado = "Por começar";
                if(!$model_resultado->save()){
                    Resultado::deleteAll(['aula_idaula' => $aula->id, 'utilizador_id' => $utilizador_id]);
                    return false;
                }
            }
        }
        else{
            return false;
        }

    }


}
