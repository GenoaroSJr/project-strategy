<?php

namespace src\Models;

class StrategyDefineMensagemEnviada
{
    private $mensagemEnviada;

    public function __construct(StrategyInterface $interfaceStrategySelecionada){
        $this->mensagemEnviada = $interfaceStrategySelecionada;
    }

    public function getMensagem(Data $data){
        return $this->mensagemEnviada->getMensagem($data);
    }

    public function getMensagemOpcao(Data $data){
        return $this->mensagemEnviada->getMensagemOpcao($data);
    }
}