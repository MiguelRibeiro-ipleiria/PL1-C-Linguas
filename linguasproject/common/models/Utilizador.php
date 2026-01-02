<?php

namespace common\models;
use app\mosquitto\phpMQTT;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $id
 * @property string $data_nascimento
 * @property int $numero_telefone
 * @property string $nacionalidade
 * @property string $data_inscricao
 * @property int $user_id
 * @property int|null $idioma_id
 *
 * @property Aula[] $aulaIdaulas
 * @property Comentario[] $comentarios
 * @property Curso[] $cursoIdcursos
 * @property Feedback[] $feedbacks
 * @property Idioma $idioma
 * @property Inscricao[] $inscricaos
 * @property Resultado[] $resultados
 * @property User $user
 */
class Utilizador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idioma_id'], 'default', 'value' => null],
            [['data_nascimento', 'numero_telefone', 'nacionalidade', 'data_inscricao', 'user_id'], 'required'],
            [['data_nascimento', 'data_inscricao'], 'safe'],
            [['numero_telefone', 'user_id', 'idioma_id'], 'integer'],
            [['nacionalidade'], 'string', 'max' => 25],
            [['idioma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::class, 'targetAttribute' => ['idioma_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_nascimento' => 'Data Nascimento',
            'numero_telefone' => 'Numero Telefone',
            'nacionalidade' => 'Nacionalidade',
            'data_inscricao' => 'Data Inscricao',
            'user_id' => 'User ID',
            'idioma_id' => 'Idioma ID',
        ];
    }

    /**
     * Gets query for [[AulaIdaulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaIdaulas()
    {
        return $this->hasMany(Aula::class, ['id' => 'aula_idaula'])->viaTable('resultado', ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[CursoIdcursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursoIdcursos()
    {
        return $this->hasMany(Curso::class, ['id' => 'curso_idcurso'])->viaTable('inscricao', ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[Idioma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdioma()
    {
        return $this->hasOne(Idioma::class, ['id' => 'idioma_id']);
    }

    /**
     * Gets query for [[Inscricaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::class, ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[Resultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultado::class, ['utilizador_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id = $this->id;
        $data_nascimento = $this->data_nascimento;
        $numero_telefone = $this->numero_telefone;
        $nacionalidade = $this->nacionalidade;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->data_nascimento=$data_nascimento;
        $myObj->numero_telefone=$numero_telefone;
        $myObj->nacionalidade=$nacionalidade;
        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublishNoMosquitto("UTILIZADOR", "Utilizador Alterado: " . $myJSON);
        else
            $this->FazPublishNoMosquitto("UTILIZADOR","Utilizador Alterado: " . $myJSON);
    }

    public function FazPublishNoMosquitto($canal,$msg)
    {
        $server = "127.0.0.1";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else { file_put_contents("debug.output","Time out!"); }
    }


}
