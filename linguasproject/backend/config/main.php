<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule','controller' => 'api/idioma', 'pluralize' => true,],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/feedback', 'pluralize' => true,],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/curso', 'pluralize' => true,
                    'extraPatterns' => [
                        'GET all' => 'allcursos',  // 'count' é 'actionCount' - conta os idiomas
                        'GET utilizador/{utilizador_id}' => 'cursoporutilizadorid',  // 'count' é 'actionCurso' - devolve o curso consoante o id
                        'GET idioma/{idioma_id}/count' => 'countporidioma', // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET idioma/{idioma_id}' => 'allcursosporidioma',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idioma_id}' => '<idioma_id:\\d+>',
                        '{utilizador_id}' => '<utilizador_id:\\d+>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/dificuldade', 'pluralize' => true,],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/inscricao' , 'pluralize' => true,
                    'extraPatterns' => [
                        'GET utilizador/{utilizador_id}/count' => 'countporuser',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET utilizador/{utilizador_id}' => 'inscricoesporuser',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET utilizador/{utilizador_id}/curso/{id}' => 'isinscrito',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'POST nova' => 'novainscricao',
                        'DELETE curso/{curso_idcurso}/utilizador/{utilizador_id}' => 'delinscricaoporid',
                        'PUT curso/{curso_idcurso}/utilizador/{utilizador_id}' => 'putdadosporcursoeutilizador',

                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{curso_idcurso}' => '<curso_idcurso:\\d+>',
                        '{utilizador_id}' => '<utilizador_id:\\d+>',

                        '{usernome}' => '<usernome:[\p{L}\p{N}\-]+>', //[a-zA-Z0-9_] 1 ou + vezes (char)
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/resultado' , 'pluralize' => true,
                    'extraPatterns' => [
                        'GET utilizador/{utilizador_id}' => 'resultadosporuser',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'PUT aula/{aula_idaula}/utilizador/{utilizador_id}' => 'putdadosporaulaeutilizador',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{aula_idaula}' => '<aula_idaula:\\d+>',
                        '{utilizador_id}' => '<utilizador_id:\\d+>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/auth',
                    'extraPatterns' => [
                        'POST login' => 'login',  // login verify action],
                    ]
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/utilizador', 'pluralize' => true,
                    'extraPatterns' => [
                        'GET {id}' => 'perfilutilizador',
                        'GET inscritos/{id}/count' => 'countcursosinscritos',
                        'GET aulaconcluidas/{id}/count' => 'countaulasterminadas',
                        'GET progresso/{id}/count' => 'countprogresso',
                        'PUT {id}' => 'putdadosporid',
                    ]
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/comentario','pluralize' => true,
                    'extraPatterns' => [
                        'GET aula/{aula_id}' => 'getcomentarioporaula',
                        'DELETE utilizador/{utilizador_id}/comentarios/{id}' => 'delporutilizadorecomentarioid',
                        'POST novo' => 'postnovo',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{aula_id}' => '<aula_id:\\d+>',
                        '{utilizador_id}' => '<utilizador_id:\\d+>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/aula','pluralize' => true,
                    'extraPatterns' => [
                        'GET {id}' => 'detalhesdaaula',
                        'GET curso/{curso_id}' => 'aulasporcurso',
                        'GET tipoexercicios/{id}' => 'tipoexerciciosporaula',
                        'GET execucao/audio/{id}' => 'aulaexecucaodeexerciciosaudios',
                        'GET execucao/frase/{id}' => 'aulaexecucaodeexerciciosfrases',
                        'GET execucao/imagem/{id}' => 'aulaexecucaodeexerciciosimagens'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{curso_id}' => '<curso_id:\\d+>',
                    ],
                ],



            ],
        ],

    ],
    'params' => $params,
];
