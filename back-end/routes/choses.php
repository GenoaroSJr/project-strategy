<?php

namespace routes;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use src\Models\Data;
use src\Models\StrategyDefineMensagemEnviada;
use src\Models\StrategyIsoladaEvento;
use src\Models\StrategyIsoladaBrasil;
use config\DB;


$app = AppFactory::create();

$app->get('/choses/API', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam("dia"),
        $request->getParam("mes"),
        $request->getParam("ano"),
        null,
        null
    );

    try{     
         //Chama a API dentro da Strategy Brasil e junta os textos;
         $evento = new StrategyDefineMensagemEnviada(new StrategyIsoladaBrasil());
         $msg = $evento->getMensagemOpcao($data);
         
         //responde com o retorno que vier da API;
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

$app->get('/choses/Brasil', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam('dia'),
        $request->getParam('mes'),
        $request->getParam('ano'),
        null,
        null
    );

    try{
        //Chama a API dentro da Strategy Brasil e junta os textos;
        $evento = new StrategyDefineMensagemEnviada(new StrategyIsoladaBrasil());
        //$msg = $evento->getMensagem($data);
        $msg = array(
            "mensagem" => $evento->getMensagem($data)
        );

        //responde com o retorno que vier da API;
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

$app->get('/choses/Eventos', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam('dia'),
        $request->getParam('mes'),
        $request->getParam('ano'),
        $request->getParam('dia_semana'),
        null
    );

    //Faz a chamada na função
    try{     
        //Chama a API dentro da Strategy Eventos;
        $evento = new StrategyDefineMensagemEnviada(new StrategyIsoladaEvento());
        //$msg = $evento->getMensagem($data);
        
        $msg = array(
            "mensagem" => $evento->getMensagem($data)
        );
        //responde com o retorno que vier da API;
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

$app->get('/choses/Agenda', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam('dia'),
        $request->getParam('mes'),
        $request->getParam('ano'),
        null,
        null
    );

    //Faz a chamada na função
    try{     
        //Chama a API dentro da Strategy Brasil e junta os textos;
        $evento = new StrategyDefineMensagemEnviada(new StrategyIsoladaEvento());
        $msg = $evento->getMensagemOpcao($data);
        
        //responde com o retorno que vier da API;
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

$app->post('/choses/add', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam('dia'),
        $request->getParam('mes'),
        $request->getParam('ano'),
        $request->getParam('dia_semana'),
        $request->getParam('msg')
    );

    $sql = "INSERT INTO eventos (dia, mes, ano, dia_semana, msg) VALUE (:dia, :mes, :ano, :dia_semana, :msg)";

    try{
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':dia', $data->dia);
        $stmt->bindParam(':mes', $data->mes);
        $stmt->bindParam(':ano', $data->ano);
        $stmt->bindParam(':dia_semana', $data->dia_semana);
        $stmt->bindParam(':msg', $data->msg);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
    }catch(PDOException $e){
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(500);
    }
});

$app->delete('/choses/delete', function(Request $request, Response $response, array $args){
    $data = new Data(
        $request->getParam('dia'),
        $request->getParam('mes'),
        $request->getParam('ano'),
        null,
        null
    );

    $sql = "DELETE FROM eventos WHERE dia=$data->dia AND mes=$data->mes AND ano=$data->ano";

    try{
        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
    }catch(PDOException $e){
        $error = array(
            "message" => $e->getMessage()
        );

        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(500);
    }
});