<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Idioma;
use common\models\Utilizador;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $data_nascimento;
    public $telefone;
    public $nacionalidade;
    public $idioma_id;
    public $user_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['data_nascimento', 'telefone', 'nacionalidade'], 'required'],
            [['data_nascimento'], 'safe'],
            [['telefone'], 'integer'],
            [['nacionalidade'], 'string', 'max' => 25],

            // Verificações de relação (FK)
            ['idioma_id', 'integer'],
            [['idioma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::class, 'targetAttribute' => ['idioma_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'data_nascimento' => 'Data de Nascimento',
            'numero_telefone' => 'Numero Telefone',
            'nacionalidade' => 'Nacionalidade',
            'idioma_id' => 'Quer ser Formador?',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        //Criar uma isntancia do Utilizado r
        //cchave estrangeira no utilizador = $user->id;
       // utilizador->save();


        $utilizador = new Utilizador();
        $utilizador->data_nascimento = $this->data_nascimento;
        if ($utilizador->data_nascimento < date('Y-m-d') && $utilizador->data_nascimento > "1900-01-01") {


            $utilizador->numero_telefone = $this->telefone;
            $utilizador->nacionalidade = $this->nacionalidade;
            $utilizador->idioma_id = $this->idioma_id;
            $utilizador->data_inscricao = date('Y-m-d H:i:s');
            $user->status = User::STATUS_ACTIVE;
            $boolusersave = $user->save();
            $utilizador->user_id = $user->id;
            $boolutilizadorsave = $utilizador->save();

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('aluno');
            $boolroleassigned = $auth->assign($authorRole, $user->getId());


        }
        else{
            $boolutilizadorsave = false;
        }

        return $boolutilizadorsave && $boolusersave && $boolroleassigned;

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
