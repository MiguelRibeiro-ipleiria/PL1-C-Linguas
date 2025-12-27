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
                ['class' => 'yii\rest\UrlRule','controller' => 'api/idioma', 'pluralize' => true,
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/curso',
                    'extraPatterns' => [
                        'GET all' => 'allcursos',  // 'count' é 'actionCount' - conta os idiomas
                        'GET count' => 'count',  // 'count' é 'actionCount' - conta os idiomas
                        'GET utilizador/{id}' => 'cursoporutilizadorid',  // 'count' é 'actionCurso' - devolve o curso consoante o id
                        'GET {idiomanome}/count' => 'countporidioma',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET {idiomanome}' => 'cursosporidioma',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idiomanome}' => '<idiomanome:[\p{L}\p{N}\-]+>', //[a-zA-Z0-9_] 1 ou + vezes (char)
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/dificuldade',
                    'extraPatterns' => [
                        'GET {id}' => 'dificuldade',  // 'count' é 'actionCurso' - devolve o curso consoante o id
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/inscricao',
                    'extraPatterns' => [
                        'GET count' => 'count',  // 'count' é 'actionCount' - conta os idiomas
                        'GET {usernome}/count' => 'countporuser',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET {usernome}' => 'inscricoesporuser',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                        'GET {usernome}/curso/{id}' => 'isinscrito',  // 'count' é 'actionCountPor' - devolve os cursos pelo idioma
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{usernome}' => '<usernome:[\p{L}\p{N}\-]+>', //[a-zA-Z0-9_] 1 ou + vezes (char)
                    ],
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/auth',
                    'extraPatterns' => [
                        'POST login' => 'login',  // login verify action],
                    ]
                ],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/utilizador',
                    'extraPatterns' => [
                        'GET {id}' => 'perfilutilizador',
                    ]
                ],
            ],
        ],

    ],
    'params' => $params,
];
