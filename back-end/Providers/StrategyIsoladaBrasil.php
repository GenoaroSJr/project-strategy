<?php

namespace Brasil;

require_once "StrategyInterface.php";

//primeira estraégia isolada
class Brasil implements StrategyInterface
{

    private $msg;
    private $evento;
    private $mensagemAPI;

    public function getMensagemOpcao($data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://public-holiday.p.rapidapi.com/$data->ano/BR",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: public-holiday.p.rapidapi.com",
                "x-rapidapi-key: 9377b31a5emshf37c90b4564e3abp1fcc7bjsn6e2145dce0a6"
            ],
        ]);

        //$datas = json_encode(curl_exec($ch),true);
        $this->mensagemAPI = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $this->mensagemAPI;
        
    }
    public function getMensagem(Data $data){
        $this->getMensagemOpcao($data);

        $x = 0;
        $evento;
        foreach($this->mensagemAPI as $mensagem){
            if($mensagem["date"] === $data->ano . "-" .$data->mes. "-" .$data->dia){
                $this->evento = $mensagem["localName"] . PHP_EOL;
            }else{
                $this->evento = null;
            }
            $x++;
        }

        if($this->evento){
            return $this->msg = "Segundo o calendário brasileiro de $data->ano, hoje, $data->dia / $data->mes, é feriado, dia de $this->evento.";
        }else{
            return $this->msg = "Segundo o calendário brasileiro de $data->ano, hoje, $data->dia / $data->mes, não é feriado.";
        }
    }
}
