<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //roles

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin do website';
        $auth->add($admin);

        $formador = $auth->createRole('formador');
        $formador->description = 'Professor de uma língua ';
        $auth->add($formador);

        $aluno = $auth->createRole('aluno');
        $aluno->description = 'Aluno que fez login';
        $auth->add($aluno);


        /*MESSAGING PERMISSIONS*/
        // CreateFeedback
        $CreateFeedback = $auth->createPermission('CreateFeedback');
        $CreateFeedback->description = 'Criar uma mensagem de feedback';
        $auth->add($CreateFeedback);

        // ReadFeedback
        $ReadFeedback = $auth->createPermission('ReadFeedback');
        $ReadFeedback->description = 'Ler (pormenores) de uma mensagem de feedback';
        $auth->add($ReadFeedback);

        // DeleteFeedback
        $DeleteFeedback = $auth->createPermission('DeleteFeedback');
        $DeleteFeedback->description = 'Eliminar uma mensagem de feedback';
        $auth->add($DeleteFeedback);

        // UpdateFeedback
        $UpdateFeedback = $auth->createPermission('UpdateFeedback');
        $UpdateFeedback->description = 'Alterar uma mensagem de feedback';
        $auth->add($UpdateFeedback);


        /*COMMENTS PERMISSIONS*/
        // CreateComment
        $CreateComment = $auth->createPermission('CreateComment');
        $CreateComment->description = 'Criar um comentário a uma aula';
        $auth->add($CreateComment);

        // ReadComment
        $ReadComment = $auth->createPermission('ReadComment');
        $ReadComment->description = 'Ler (pormenores) de um comentário de uma aula';
        $auth->add($ReadComment);

        // UpdateComment
        $UpdateComment = $auth->createPermission('UpdateComment');
        $UpdateComment->description = 'Alterar contéudo do comentário de uma aula';
        $auth->add($UpdateComment);

        // DeleteComment
        $DeleteComment = $auth->createPermission('DeleteComment');
        $DeleteComment->description = 'Eliminar um comentário de uma aula';
        $auth->add($DeleteComment);




        /*DIFICULDADE MANAGEMENT PERMISSIONS*/
        // add "ReadDificuldade" permission
        $ReadDificuldade = $auth->createPermission('ReadDificuldade');
        $ReadDificuldade->description = 'Ler os dados do grau de dificuldade';
        $auth->add($ReadDificuldade);

        // add "UpdateDificuldade" permission
        $UpdateDificuldade = $auth->createPermission('UpdateDificuldade');
        $UpdateDificuldade->description = 'Atualizar um grau de dificuldade';
        $auth->add($UpdateDificuldade);

        // add "CreateDificuldade" permission
        $CreateDificuldade = $auth->createPermission('CreateDificuldade');
        $CreateDificuldade->description = 'Criar um grau de dificuldade';
        $auth->add($CreateDificuldade);

        // add "DeleteDificuldade" permission
        $DeleteDificuldade = $auth->createPermission('DeleteDificuldade');
        $DeleteDificuldade->description = 'Eliminar um grau de dificuldade';
        $auth->add($DeleteDificuldade);



        /*USER MANAGEMENT PERMISSIONS*/
        // add "ReadUser" permission
        $ReadUser = $auth->createPermission('ReadUser');
        $ReadUser->description = 'Ler os dados do utilizador';
        $auth->add($ReadUser);

        // add "UpdateUser" permission
        $UpdateUser = $auth->createPermission('UpdateUser');
        $UpdateUser->description = 'Atualizar os dados do utilizador';
        $auth->add($UpdateUser);

        $CreateUser = $auth->createPermission('CreateUser');
        $CreateUser->description = 'Criar um utilizador';
        $auth->add($CreateUser);

        // add "DeleteUser" permission
        $DeleteUser = $auth->createPermission('DeleteUser');
        $DeleteUser->description = 'Eliminar um utilizador';
        $auth->add($DeleteUser);


        /*COURSES MANAGEMENT PERMISSIONS*/
        // ToggleCourse
        $ToggleCourse = $auth->createPermission('ToggleCourse');
        $ToggleCourse->description = 'Ativar ou desativar cursos temporariamente';
        $auth->add($ToggleCourse);

        // add "CreateCourse" permission
        $CreateCourse = $auth->createPermission('CreateCourse');
        $CreateCourse->description = 'Criar um curso de uma lingua';
        $auth->add($CreateCourse);

        // add "ReadCourse" permission
        $ReadCourse = $auth->createPermission('ReadCourse');
        $ReadCourse->description = 'Ler os dados de um curso para uma lingua';
        $auth->add($ReadCourse);

        // add "UpdateCourse" permission
        $UpdateCourse = $auth->createPermission('UpdateCourse');
        $UpdateCourse->description = 'Atualizar os dados de um curso de uma lingua';
        $auth->add($UpdateCourse);

        // add "DeleteCourse" permission
        $DeleteCourse = $auth->createPermission('DeleteCourse');
        $DeleteCourse->description = 'Eliminar um curso de uma lingua';
        $auth->add($DeleteCourse);

        // SearchCourse
        $SearchCourse = $auth->createPermission('SearchCourse');
        $SearchCourse->description = 'Ver detalhes dos cursos';
        $auth->add($SearchCourse);


        /*LESSONS MANAGEMENT PERMISSIONS*/
        // add "CreateLesson" permission
        $CreateLesson = $auth->createPermission('CreateLesson');
        $CreateLesson->description = 'Criar uma aula para um curso';
        $auth->add($CreateLesson);

        // add "ReadLesson" permission
        $ReadLesson = $auth->createPermission('ReadLesson');
        $ReadLesson->description = 'Ler dos dados de uma aula de um curso';
        $auth->add($ReadLesson);

        // add "UpdateLesson" permission
        $UpdateLesson = $auth->createPermission('UpdateLesson');
        $UpdateLesson->description = 'Atualizar os dados de um aula de um curso';
        $auth->add($UpdateLesson);

        // add "DeleteLesson" permission
        $DeleteLesson = $auth->createPermission('DeleteLesson');
        $DeleteLesson->description = 'Eliminar uma aula de um curso';
        $auth->add($DeleteLesson);




        /*LANGUAGE MANAGEMENT PERMISSIONS*/
        // CreateLanguage
        $CreateLanguage = $auth->createPermission('CreateLanguage');
        $CreateLanguage->description = 'Adicionar idiomas disponíveis na plataforma';
        $auth->add($CreateLanguage);

        // ReadLanguage
        $ReadLanguage = $auth->createPermission('ReadLanguage');
        $ReadLanguage->description = 'Ver idiomas disponíveis na plataforma';
        $auth->add($ReadLanguage);

        // UpdateLanguage
        $UpdateLanguage = $auth->createPermission('UpdateLanguage');
        $UpdateLanguage->description = 'Editar informações de idiomas';
        $auth->add($UpdateLanguage);

        // DeleteLanguage
        $DeleteLanguage = $auth->createPermission('DeleteLanguage');
        $DeleteLanguage->description = 'Eliminar idiomas da plataforma';
        $auth->add($DeleteLanguage);

        // SearchLanguage
        $SearchLanguage = $auth->createPermission('SearchLanguage');
        $SearchLanguage->description = 'Pesquisar línguas disponíveis';
        $auth->add($SearchLanguage);


        /* RESOURCES IMAGE AND AUDIO PERMISSONS */

        // CreateLessonImage
        $CreateLessonImage = $auth->createPermission('CreateLessonImage');
        $CreateLessonImage->description = 'Carregar imagens usadas nas aulas';
        $auth->add($CreateLessonImage);

        // DeleteLessonImage
        $DeleteLessonImage = $auth->createPermission('DeleteLessonImage');
        $DeleteLessonImage->description = 'Eliminar imagens usadas nas aulas';
        $auth->add($DeleteLessonImage);

        // ReadLessonImage
        $ReadLessonImage = $auth->createPermission('ReadLessonImage');
        $ReadLessonImage->description = 'Ler dados das imagens usadas nas aulas';
        $auth->add($ReadLessonImage);

        // UpdateLessonImage
        $UpdateLessonImage = $auth->createPermission('UpdateLessonImage');
        $UpdateLessonImage->description = 'Editar dados das imagens usadas nas aulas';
        $auth->add($UpdateLessonImage);

        // CreateLessonSound
        $CreateLessonSound = $auth->createPermission('CreateLessonSound');
        $CreateLessonSound->description = 'Carregar um som usado nas aulas';
        $auth->add($CreateLessonSound);

        // DeleteLessonSound
        $DeleteLessonSound = $auth->createPermission('DeleteLessonSound');
        $DeleteLessonSound->description = 'Eliminar um som usado nas aulas';
        $auth->add($DeleteLessonSound);

        // ReadLessonSound
        $ReadLessonSound = $auth->createPermission('ReadLessonSound');
        $ReadLessonSound->description = 'Ler dado de um som usado nas aulas';
        $auth->add($ReadLessonSound);

        // UpdateLessonSound
        $UpdateLessonSound = $auth->createPermission('UpdateLessonSound');
        $UpdateLessonSound->description = 'Editar dados de um som usado nas aulas';
        $auth->add($UpdateLessonSound);

        // BackendAccess
        $CanAccessBackend = $auth->createPermission('CanAccessBackend');
        $CanAccessBackend->description = 'Users que podem aceder ás páginas do backend';
        $auth->add($CanAccessBackend);


        /* IMAGE, AUDIO AND FRASE EXERCICIOS PERMISSONS */



        /* AUDIOS */

        // CreateLessonImage
        $CreateExerciseImage = $auth->createPermission('CreateExerciseImage');
        $CreateExerciseImage->description = 'Criar um exercicio de imagens para as aulas';
        $auth->add($CreateExerciseImage);

        // DeleteLessonImage
        $DeleteExerciseImage = $auth->createPermission('DeleteExerciseImage');
        $DeleteExerciseImage->description = 'Eliminar um exercicio de imagens para as aulas';
        $auth->add($DeleteExerciseImage);

        // ReadLessonImage
        $ReadExerciseImage = $auth->createPermission('ReadExerciseImage');
        $ReadExerciseImage->description = 'Ler um exercicio de imagens para as aulas';
        $auth->add($ReadExerciseImage);

        // UpdateLessonImage
        $UpdateExerciseImage = $auth->createPermission('UpdateExerciseImage');
        $UpdateExerciseImage->description = 'Alterar um exercicio de imagens para as aulas';
        $auth->add($UpdateExerciseImage);

        /* AUDIOS */

        // CreateLessonSound
        $CreateExerciseSound = $auth->createPermission('CreateExerciseSound');
        $CreateExerciseSound->description = 'Criar um exercicio de áudio para as aulas';
        $auth->add($CreateExerciseSound);

        // DeleteLessonSound
        $DeleteExerciseSound = $auth->createPermission('DeleteExerciseSound');
        $DeleteExerciseSound->description = 'Eliminar um exercicio de áudio para as aulas';
        $auth->add($DeleteExerciseSound);

        // ReadLessonSound
        $ReadExerciseSound = $auth->createPermission('ReadExerciseSound');
        $ReadExerciseSound->description = 'Ler um exercicio de áudio para as aulas';
        $auth->add($ReadExerciseSound);

        // UpdateLessonSound
        $UpdateExerciseSound = $auth->createPermission('UpdateExerciseSound');
        $UpdateExerciseSound->description = 'Alterar um exercicio de áudio para as aulas';
        $auth->add($UpdateExerciseSound);


        /* FRASES */
        // CreateLessonSound
        $CreateExerciseFrase = $auth->createPermission('CreateExerciseFrase');
        $CreateExerciseFrase->description = 'Criar um exercicio de áudio para as aulas';
        $auth->add($CreateExerciseFrase);

        // DeleteLessonSound
        $DeleteExerciseFrase = $auth->createPermission('DeleteExerciseFrase');
        $DeleteExerciseFrase->description = 'Eliminar um exercicio de áudio para as aulas';
        $auth->add($DeleteExerciseFrase);

        // ReadLessonSound
        $ReadExerciseFrase = $auth->createPermission('ReadExerciseFrase');
        $ReadExerciseFrase->description = 'Ler um exercicio de áudio para as aulas';
        $auth->add($ReadExerciseFrase);

        // UpdateLessonSound
        $UpdateExerciseFrase = $auth->createPermission('UpdateExerciseFrase');
        $UpdateExerciseFrase->description = 'Alterar um exercicio de áudio para as aulas';
        $auth->add($UpdateExerciseFrase);



         /*  Tipos exercicios permissions  */

        //ReadTipoExercicio
        $ReadTipoExercicio = $auth->createPermission('ReadTipoExercicio');
        $ReadTipoExercicio->description = 'Ver os tipos de exercicio';
        $auth->add($ReadTipoExercicio);

        //CreateTipoExercicio
        $CreateTipoExercicio = $auth->createPermission('CreateTipoExercicio');
        $CreateTipoExercicio->description = 'Criar um tipo de exercicio';
        $auth->add($CreateTipoExercicio);
        
        //UpdateTipoExercicio
        $UpdateTipoExercicio = $auth->createPermission('UpdateTipoExercicio');
        $UpdateTipoExercicio->description = 'Atualizar um tipo de exercicio';
        $auth->add($UpdateTipoExercicio);

        //DeleteTipoExercicio
        $DeleteTipoExercicio = $auth->createPermission('DeleteTipoExercicio');
        $DeleteTipoExercicio->description ='Eliminar tipo de exercicio';
        $auth->add($DeleteTipoExercicio);


        /* MY PROFILE ACCESS */

        $CanAccessMeuProfile = $auth->createPermission('CanAccessMeuProfile');
        $CanAccessMeuProfile->description = 'Users podem aceder ao seu profile';
        $auth->add($CanAccessMeuProfile);

        $CanAccessMeusCursoseAulas = $auth->createPermission('CanAccessMeusCursoseAulas');
        $CanAccessMeusCursoseAulas->description = 'Users podem aceder aos seus cursos e aulas incritos';
        $auth->add($CanAccessMeusCursoseAulas);

        $CanAccessMeusComentarios = $auth->createPermission('CanAccessMeusComentarios');
        $CanAccessMeusComentarios->description = 'Users podem aceder aos seus comentários realizados';
        $auth->add($CanAccessMeusComentarios);

        $CanAccessMeusProgressos = $auth->createPermission('CanAccessMeusProgressos');
        $CanAccessMeusProgressos->description = 'Users podem aceder aos seus progressos';
        $auth->add($CanAccessMeusProgressos);

        $CanAccessMeusFeedbacks = $auth->createPermission('CanAccessMeusFeedbacks');
        $CanAccessMeusFeedbacks->description = 'Users podem aceder aos seus feedbacks';
        $auth->add($CanAccessMeusFeedbacks);


        /* ACESSO ÁS INCRICOES */

        $ReadInscricoes = $auth->createPermission('ReadInscricoes');
        $ReadInscricoes->description = 'Ver as inscricoes de todos os users';
        $auth->add($ReadInscricoes);

        $CreateInscricoes = $auth->createPermission('CreateInscricoes');
        $CreateInscricoes->description = 'Criar uma inscricao';
        $auth->add($CreateInscricoes);

        $DeleteInscricoes = $auth->createPermission('DeleteInscricoes');
        $DeleteInscricoes->description = 'Eliminar incricao de um user';
        $auth->add($DeleteInscricoes);

        $UpdateInscricoes = $auth->createPermission('UpdateInscricoes');
        $UpdateInscricoes->description = 'Alterar algum dado da inscricao de um user';
        $auth->add($UpdateInscricoes);




        /*----------------Profile Managment-----------*/
        //admin
        $auth->addChild($admin, $CanAccessMeuProfile);
        $auth->addChild($admin, $CanAccessMeusCursoseAulas);
        $auth->addChild($admin, $CanAccessMeusComentarios);
        $auth->addChild($admin, $CanAccessMeusProgressos);
        $auth->addChild($admin, $CanAccessMeusFeedbacks);

        //formador
        $auth->addChild($formador, $CanAccessMeuProfile);
        $auth->addChild($formador, $CanAccessMeusCursoseAulas);
        $auth->addChild($formador, $CanAccessMeusComentarios);
        $auth->addChild($formador, $CanAccessMeusProgressos);
        $auth->addChild($formador, $CanAccessMeusFeedbacks);

        //aluno
        $auth->addChild($aluno, $CanAccessMeuProfile);
        $auth->addChild($aluno, $CanAccessMeusCursoseAulas);
        $auth->addChild($aluno, $CanAccessMeusComentarios);
        $auth->addChild($aluno, $CanAccessMeusProgressos);
        $auth->addChild($aluno, $CanAccessMeusFeedbacks);


        /*------------Inscricoes Managment-------------*/
        //admin
        $auth->addChild($admin, $ReadInscricoes);
        $auth->addChild($admin, $CreateInscricoes);
        $auth->addChild($admin, $DeleteInscricoes);
        $auth->addChild($admin, $UpdateInscricoes);

        //formador
        $auth->addChild($formador, $CreateInscricoes);

        //aluno
        $auth->addChild($aluno, $CreateInscricoes);


        /*----------------Backend Managment-----------*/
        //admin
        $auth->addChild($admin, $CanAccessBackend);
        //formador
        $auth->addChild($formador, $CanAccessBackend);


        /*----------------Feedback managment-----------*/
        //admin         
        $auth->addChild($admin, $CreateFeedback);
        $auth->addChild($admin, $ReadFeedback);
        $auth->addChild($admin, $DeleteFeedback);
        $auth->addChild($admin, $UpdateFeedback);

        //formador
        $auth->addChild($formador, $CreateFeedback);
        $auth->addChild($formador, $DeleteFeedback);

        //user autenticado
        $auth->addChild($aluno, $CreateFeedback);
        $auth->addChild($aluno, $DeleteFeedback);


        /*----------------Dificuldade managment-----------*/
        //admin
        $auth->addChild($admin, $CreateDificuldade);
        $auth->addChild($admin, $ReadDificuldade);
        $auth->addChild($admin, $DeleteDificuldade);
        $auth->addChild($admin, $UpdateDificuldade);


        /*----------------Comment management-----------*/

        //admin
        $auth->addChild($admin, $CreateComment);
        $auth->addChild($admin, $ReadComment);
        $auth->addChild($admin, $UpdateComment);
        $auth->addChild($admin, $DeleteComment);

        //formador
        $auth->addChild($formador, $CreateComment);
        $auth->addChild($formador, $UpdateComment);
        $auth->addChild($formador, $DeleteComment);

        //user autenticado
        $auth->addChild($aluno, $CreateComment);
        $auth->addChild($aluno, $UpdateComment);
        $auth->addChild($aluno, $DeleteComment);

        /*------------------USER MANAGEMENT------------*/
        //admin
        $auth->addChild($admin, $ReadUser);
        $auth->addChild($admin, $UpdateUser);
        $auth->addChild($admin, $DeleteUser);
        $auth->addChild($admin, $CreateUser);

        /*------------------Courses management----------*/
        //admin
        $auth->addChild($admin, $ToggleCourse);
        $auth->addChild($admin, $CreateCourse); 
        $auth->addChild($admin, $ReadCourse);
        $auth->addChild($admin, $UpdateCourse);
        $auth->addChild($admin, $DeleteCourse);
        $auth->addChild($admin, $SearchCourse);


        //formador
        $auth->addChild($formador, $CreateCourse);
        $auth->addChild($formador, $ReadCourse);
        $auth->addChild($formador, $UpdateCourse);
        $auth->addChild($formador, $DeleteCourse);
        $auth->addChild($formador, $SearchCourse);

        //aluno
        $auth->addChild($aluno, $SearchCourse);

        /*----------------lessons management-----------*/
        //admin
        $auth->addChild($admin, $CreateLesson);
        $auth->addChild($admin, $ReadLesson);
        $auth->addChild($admin, $UpdateLesson);
        $auth->addChild($admin, $DeleteLesson);

        //formador
        $auth->addChild($formador, $CreateLesson);
        $auth->addChild($formador, $ReadLesson);
        $auth->addChild($formador, $UpdateLesson);
        $auth->addChild($formador, $DeleteLesson);

         /*----------------Language management-----------*/
        //Admin
         $auth->addChild($admin, $CreateLanguage);
         $auth->addChild($admin, $ReadLanguage);
         $auth->addChild($admin, $UpdateLanguage);
         $auth->addChild($admin, $DeleteLanguage);
         $auth->addChild($admin, $SearchLanguage);

         //formador
         $auth->addChild($formador, $SearchLanguage);

         //aluno
         $auth->addChild($aluno, $SearchLanguage);


        /*----------------Resources management-----------*/
        //Admin
         $auth->addChild($admin, $CreateLessonImage);
         $auth->addChild($admin, $DeleteLessonImage);
         $auth->addChild($admin, $ReadLessonImage);
         $auth->addChild($admin, $UpdateLessonImage);
         $auth->addChild($admin, $CreateLessonSound);
         $auth->addChild($admin, $DeleteLessonSound);
         $auth->addChild($admin, $ReadLessonSound);
         $auth->addChild($admin, $UpdateLessonSound);

        //formador
        $auth->addChild($formador, $CreateLessonImage);
        $auth->addChild($formador, $DeleteLessonImage);
        $auth->addChild($formador, $ReadLessonImage);   
        $auth->addChild($formador, $UpdateLessonImage);
        $auth->addChild($formador, $CreateLessonSound);
        $auth->addChild($formador, $DeleteLessonSound);
        $auth->addChild($formador, $ReadLessonSound);
        $auth->addChild($formador, $UpdateLessonSound);


        /*---------------- Tipos de exercicios management-----------*/

        //Admin
         $auth->addChild($admin, $CreateTipoExercicio);
         $auth->addChild($admin, $DeleteTipoExercicio);
         $auth->addChild($admin, $ReadTipoExercicio);
         $auth->addChild($admin, $UpdateTipoExercicio);


        echo "RBAC inicializado com sucesso!\n";

    }
}