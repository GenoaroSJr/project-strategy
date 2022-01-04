<?php

namespace Data;

//coletando a data:
class Data
{
    public $dia;
    public $mes;
    public $ano;
    public $dia_semana;
    public $msg;

    function __construct($dia,$mes,$ano,$dia_semana,$msg){
        $this->dia = $dia;
        $this->mes = $mes;
        $this->ano = $ano;
        $this->dia_semana = $dia_semana;
        $this->msg = $msg;
    }
}
