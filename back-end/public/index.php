<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

//Choses Routes
require __DIR__ . '/../routes/choses.php';

$app->get('/', function (Request $request, Response $response){
    $msg = array(
        "mensage" => "Essa API foi desenvolvida como critério de aceite para área de desenvolvimento, back-end, da empresa INCLUIR TECNOLOGIA."
    );
    try{     
        $response->getBody()->write(json_encode($msg));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(200);
   } catch(Error $er){
       $error = array(
           "message" => $er->getMessage()
       );

       $response->getBody()->write(json_encode($error));
       return $response
           ->withHeader('content-type', 'application/json')
           ->withStatus(500);  
   }
});

$app->run();
