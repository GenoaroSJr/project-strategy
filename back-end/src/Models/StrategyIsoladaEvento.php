<?php

namespace src\Models;
use src\Models\StrategyInterface;
use config\DB;
use PDO;

//primeira estraégia isolada
class StrategyIsoladaEvento implements StrategyInterface
{
    private $eventos = array(
        '0'=>'Domingo: Descanse pois amanha é dia de trabalho!',
        '1'=>'Segunda-Feira: Que possa ter um bom trabalho essa semana!',
        '2'=>'Terça-Feira: Que tal comer um pastel na feira?',
        '3'=>'Quarta-Feira: Cervejinha e bola, bora?',
        '4'=>'Quinta-Feira: Se não fosse tão perna de pau, poderia estar caminhando tranquilamenta para o trabalho!',
        '5'=>'Sexta-Feira: Ahh já sinto o gosto da cerveja!!',
        '6'=>'Sábado: Enfim, sobrevivemos! Descanse, companheiro!'
    ); 

    private $msg;
    private $mensagemDoDia;
    private $mensagemEvento;

    public function getMensagemOpcao($data){
        
        $sql = "SELECT msg FROM eventos WHERE dia=$data->dia AND mes=$data->mes AND ano=$data->ano";

        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->query($sql);
        $this->mensagemEvento = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->mensagemEvento;
        
    }

    public function getMensagem(Data $data){
        $this->getMensagemOpcao($data);
        $this->mensagemDoDia = $this->eventos[$data->dia_semana];

        $msgEventos = null;
        if($this->mensagemEvento){
            foreach($this->mensagemEvento as $msgEnv=>$texto){
                $msgEventos.= ' '.$texto["msg"];
            }
            
            $this->msg = $this->mensagemDoDia . ' Sua agenda de hoje:' . $msgEventos;
            return $this->msg;

        }else{
            return $this->mensagemDoDia;
        }         

    }
}
