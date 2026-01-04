<?php

namespace common\models;
use common\models\Frase;
use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property int $id
 * @property string $titulo_aula
 * @property string $descricao_aula
 * @property int $numero_de_exercicios
 * @property string $tempo_estimado
 * @property int $curso_id
 * @property string $data_criacao
 *
 * @property AudioResource[] $audioResources
 * @property Audio[] $audios
 * @property Curso $curso
 * @property Frase[] $frases
 * @property ImagemResource[] $imagemResources
 * @property Imagem[] $imagems
 */
class Aula extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo_aula', 'descricao_aula', 'numero_de_exercicios', 'tempo_estimado', 'curso_id', 'data_criacao'], 'required'],
            [['numero_de_exercicios', 'curso_id'], 'integer'],
            [['titulo_aula'], 'string', 'max' => 50],
            [['descricao_aula'], 'string', 'max' => 80],
            [['tempo_estimado'], 'string', 'max' => 25],
            [['data_criacao'], 'string', 'max' => 45],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::class, 'targetAttribute' => ['curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo_aula' => 'Titulo Aula',
            'descricao_aula' => 'Descricao Aula',
            'numero_de_exercicios' => 'Numero De Exercicios',
            'tempo_estimado' => 'Tempo Estimado',
            'curso_id' => 'Curso',
            'data_criacao' => 'Data Criacao',
        ];
    }

    /**
     * Gets query for [[AudioResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudioResources()
    {
        return $this->hasMany(AudioResource::class, ['id' => 'audio_resource_id'])->viaTable('audio', ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Audios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudios()
    {
        return $this->hasMany(Audio::class, ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::class, ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[Frases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrases()
    {
        return $this->hasMany(Frase::class, ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[ImagemResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemResources()
    {
        return $this->hasMany(ImagemResource::class, ['id' => 'imagem_resource_id'])->viaTable('imagem', ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::class, ['aula_id' => 'id']);
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['aula_id' => 'id']);
    }

    public function VerificaRespostadoExercicio($id_opcao){

        $opcao = Opcoesai::find()->where(['id' => $id_opcao])->one();
        if($opcao->iscorreta == true){
            return true;
        }
        else{
            return false;
        }

        /*if($opcao->audio_aula_id == null){
            $opcoes = Opcoesai::find()->where(['id' => $id_opcao])->one();

        }
        elseif($opcao->frase_id == null){

        }
        elseif($opcao->imagem_aula_id == null){

        }*/
    }


    public function setOpcaoRespondidaSession($id) {
        $session = Yii::$app->session;
        $session->set('OpcaoRespondida', $id);
    }

    public function getOpcaoRespondidaSession()
    {
        $session = Yii::$app->session;
        return $session->get('OpcaoRespondida');

    }


    public function setExercisesFrasesDoneSession($id) {
        $session = Yii::$app->session;

        if ($session->has('frasesDone')) {
            $arrayFrasesDone = $session->get('frasesDone');
        } else {
            $arrayFrasesDone = [];
        }

        array_push($arrayFrasesDone, $id);

        $session->set('frasesDone', $arrayFrasesDone);
    }

    public function getExercisesFraseDoneSession()
    {
        $session = Yii::$app->session;
        return $session->get('frasesDone');

    }

    public function setExercisesImagensDoneSession($id) {
        $session = Yii::$app->session;

        if ($session->has('imagensDone')) {
            $arrayImagensDone = $session->get('imagensDone');
        } else {
            $arrayImagensDone = [];
        }

        array_push($arrayImagensDone, $id);

        $session->set('imagensDone', $arrayImagensDone);
    }

    public function getExercisesImagensDoneSession()
    {
        $session = Yii::$app->session;
        return $session->get('imagensDone');

    }


    public function setExercisesAudiosDoneSession($id) {
        $session = Yii::$app->session;

        if ($session->has('audiosDone')) {
            $arrayAudiosDone = $session->get('audiosDone');
        } else {
            $arrayAudiosDone = [];
        }

        array_push($arrayAudiosDone, $id);

        $session->set('audiosDone', $arrayAudiosDone);
    }

    public function getExercisesAudiosDoneSession()
    {
        $session = Yii::$app->session;
        return $session->get('audiosDone');

    }


    public function clearSessionExercises() {
        session_destroy();
    }





}
