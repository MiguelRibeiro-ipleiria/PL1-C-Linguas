<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resultado".
 *
 * @property int $utilizador_id
 * @property int $aula_idaula
 * @property string|null $data_inicio
 * @property string|null $data_fim
 * @property string $estado
 * @property int|null $nota
 * @property string|null $tempo_estimado
 * @property string|null $data_agendamento
 * @property int|null $respostas_certas
 * @property int|null $respostas_erradas
 *
 * @property Aula $aulaIdaula
 * @property Utilizador $utilizador
 */
class Resultado extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resultado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_inicio', 'data_fim', 'nota', 'tempo_estimado', 'data_agendamento', 'respostas_certas', 'respostas_erradas'], 'default', 'value' => null],
            [['utilizador_id', 'aula_idaula', 'estado'], 'required'],
            [['utilizador_id', 'aula_idaula', 'nota', 'respostas_certas', 'respostas_erradas'], 'integer'],
            [['data_inicio', 'data_fim', 'data_agendamento', 'tempo_estimado'], 'safe'],
            [['estado'], 'string', 'max' => 45],
            [['utilizador_id', 'aula_idaula'], 'unique', 'targetAttribute' => ['utilizador_id', 'aula_idaula']],
            [['aula_idaula'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_idaula' => 'id']],
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
            'aula_idaula' => 'Aula Idaula',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'estado' => 'Estado',
            'nota' => 'Nota',
            'tempo_estimado' => 'Tempo Estimado',
            'data_agendamento' => 'Data Agendamento',
            'respostas_certas' => 'Respostas Certas',
            'respostas_erradas' => 'Respostas Erradas',
        ];
    }

    /**
     * Gets query for [[AulaIdaula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaIdaula()
    {
        return $this->hasOne(Aula::class, ['id' => 'aula_idaula']);
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

    public static function ReeinscreverUtilizadoresEmAulas($aula_id){

        $aula = Aula::findOne($aula_id);
        if(!$aula){
            return false;
        }
        $curso = $aula->curso;
        if(!$curso){
            return false;
        }

        $inscricoes = Inscricao::find()->where(['curso_idcurso' => $curso->id])->all();

        if($inscricoes){
            foreach ($inscricoes as $inscricao) {
                $resultado = new Resultado();
                $resultado->utilizador_id = $inscricao->utilizador_id;
                $resultado->aula_idaula = $aula->id;
                $resultado->estado = "Por começar";
                if(!$resultado->save()){
                    Resultado::deleteAll(['aula_idaula' => $aula->id]);
                    return false;
                }
                $inscricao = Inscricao::find()->where(['curso_idcurso' => $curso->id, 'utilizador_id' => $resultado->utilizador_id])->one();
                if(!Inscricao::VerificaEstadoCurso($curso->id, $inscricao->utilizador_id)){
                    $inscricao->estado = "Em curso";
                }
                else{
                    $inscricao->estado = "Concluído";
                }
                if(!$inscricao->save()){
                    return false;
                }
            }
            return true;
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        //Obter dados do registo em causa
        $utilizador_id = $this->utilizador_id;
        $aula_idaula = $this->aula_idaula;
        $data_inicio = $this->data_inicio ;
        $data_fim = $this->data_fim;
        $data_agendamento = $this->data_agendamento;
        $nota = $this->nota;
        $estado = $this->estado;
        $tempo_estimado = $this->tempo_estimado;
        $respostas_certas = $this->respostas_certas;
        $respostas_erradas = $this->respostas_erradas;


        $myObj=new \stdClass();
        $myObj->utilizador_id=$utilizador_id;
        $myObj->aula_idaula=$aula_idaula;
        $myObj->data_inicio=$data_inicio;
        $myObj->data_fim=$data_fim;
        $myObj->data_agendamento=$data_agendamento;
        $myObj->nota=$nota;
        $myObj->estado=$estado;
        $myObj->tempo_estimado=$tempo_estimado;
        $myObj->respostas_certas=$respostas_certas;
        $myObj->respostas_erradas=$respostas_erradas;

        $myJSON = json_encode($myObj);
        if($insert)
            $this->FazPublishNoMosquitto("RESULTADOS", "Resultado Criado:" . $myJSON);
        else
            $this->FazPublishNoMosquitto("RESULTADOS", "Resultado Atualizado:" . $myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $utilizador_id= $this->utilizador_id;
        $aula_idaula= $this->aula_idaula;
        $myObj=new \stdClass();
        $myObj->utilizador_id=$utilizador_id;
        $myObj->aula_idaula=$aula_idaula;
        $myJSON = json_encode($myObj);
        $this->FazPublishNoMosquitto("RESULTADOS", "Resultado Eliminado: ". $myJSON);
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
