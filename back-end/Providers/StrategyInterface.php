<?php

//interface 
interface StrategyInterface 
{
    public function getMensagemOpcao(Data $data);
    public function getMensagem(Data $data);
}