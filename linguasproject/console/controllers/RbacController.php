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

        $user_autenticado = $auth->createRole('aluno');
        $user_autenticado->description = 'Aluno que fez login';
        $auth->add($user_autenticado);


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


        /*USER MANAGEMENT PERMISSIONS*/
        // add "ReadUser" permission
        $ReadUser = $auth->createPermission('ReadUser');
        $ReadUser->description = 'Ler os dados do utilizador';
        $auth->add($ReadUser);

        // add "UpdateUser" permission
        $UpdateUser = $auth->createPermission('UpdateUser');
        $UpdateUser->description = 'Atualizar os dados do utilizador';
        $auth->add($UpdateUser);

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

        //formador
        $auth->addChild($formador, $CreateFeedback);
        $auth->addChild($formador, $DeleteFeedback);

        //user autenticado
        $auth->addChild($user_autenticado, $CreateFeedback);
        $auth->addChild($user_autenticado, $DeleteFeedback);
        
        /*----------------Comment management-----------*/

        //admin
        $auth->addChild($admin, $CreateComment);
        $auth->addChild($admin, $ReadComment);
        $auth->addChild($admin, $UpdateComment);
        $auth->addChild($admin, $DeleteComment);

        //formador
        $auth->addChild($formador, $CreateComment);
        $auth->addChild($formador, $ReadComment);
        $auth->addChild($formador, $UpdateComment);
        $auth->addChild($formador, $DeleteComment);

        //user autenticado
        $auth->addChild($user_autenticado, $CreateComment);
        $auth->addChild($user_autenticado, $ReadComment);
        $auth->addChild($user_autenticado, $UpdateComment);
        $auth->addChild($user_autenticado, $DeleteComment);

        /*------------------USER MANAGEMENT------------*/
        //admin
        $auth->addChild($admin, $ReadUser);
        $auth->addChild($admin, $UpdateUser);
        $auth->addChild($admin, $DeleteUser);

        /*------------------Courses management----------*/
        //admin
        $auth->addChild($admin, $ToggleCourse);
        $auth->addChild($admin, $CreateCourse); 
        $auth->addChild($admin, $ReadCourse);
        $auth->addChild($admin, $UpdateCourse);
        $auth->addChild($admin, $DeleteCourse);

        //formador
        $auth->addChild($formador, $CreateCourse);
        $auth->addChild($formador, $ReadCourse);
        $auth->addChild($formador, $UpdateCourse);
        $auth->addChild($formador, $DeleteCourse);


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

         //user autenticado
         $auth->addChild($user_autenticado, $SearchLanguage);


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





        echo "RBAC inicializado com sucesso!\n";

    }
}