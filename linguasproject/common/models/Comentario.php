<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property string $descricao_comentario
 * @property int $aula_id
 * @property string $hora_criada
 * @property int $utilizador_id
 *
 * @property Aula $aula
 * @property Utilizador $utilizador
 */
class Comentario extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao_comentario', 'aula_id', 'hora_criada', 'utilizador_id'], 'required'],
            [['aula_id', 'utilizador_id'], 'integer'],
            [['hora_criada'], 'safe'],
            [['descricao_comentario'], 'string', 'max' => 600],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['utilizador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao_comentario' => 'Comentário*',
            'aula_id' => 'Aula ID',
            'hora_criada' => 'Hora Criada',
            'utilizador_id' => 'Utilizador ID',
        ];
    }

    /**
     * Gets query for [[Aula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aula::class, ['id' => 'aula_id']);
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

    public function setDataCriacao()
    {
        $hora = date('y-m-d H:i:s');
        return $this->hora_criada = $hora;
    }

    public function setUtilizador()
    {
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->identity->getId()])->one();
        return $this->utilizador_id = $utilizador->id;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $id = $this->id;
        $descricao_comentario = $this->descricao_comentario;
        $aula_id = $this->aula_id;
        $hora_criada = $this->hora_criada ;
        $utilizador_id = $this->utilizador_id;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->descricao_comentario=$descricao_comentario;
        $myObj->aula_id=$aula_id;
        $myObj->hora_criada=$hora_criada;
        $myObj->utilizador_id=$utilizador_id;
        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublishNoMosquitto("COMENTARIOS", "Comentário Criado:" . $myJSON);
        else
            $this->FazPublishNoMosquitto("COMENTARIOS",$myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON = json_encode($myObj);
        $this->FazPublishNoMosquitto("COMENTARIOS", "Comentário Eliminado: ". $myJSON);
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
