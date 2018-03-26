<?php

/////----**** 1°PARTE ****---/////

//Meus dias da semana, montada em meu Array vindo de um formulário HTML com vários dias selecionados.......
//Tue, Wed, Thu, Fri, Sat, Sun, Mon
//Ter, Qua, Qui, Sex, Sáb, Dom, Seg
//Meu array com as dias escritos
//'1' => 'Segunda', '2' => 'Terça', '3' => 'Quarta', '4' => 'Quinta', '5' => 'Sexta', '6' => 'Sábado'
//pegar o codigo dos dias selecionados e descobrir que dia são

//dias da semana selecionada
$string_days_week = '1,3,5';

//Aqui está a minha data inícial e final
$data_inicial     = '23/03/2018';
$data_final       = '23/03/2019';

//Hora agendada
$hour = '06:30';
//Campos esses que recebi via POST

/////----**** 2°PARTE ****---/////

$expl_dias = explode(',',$string_days_week);
$pegar_dias = '';
foreach($expl_dias as $dias){
    //verificar os dias selecionados com os dias que vão ser gerados.
    //Chamo a função listadias(), nela contém um laço com tados os dias entre a data início e fim
  if($dias == '1'){
      $D = 'Mon';
      listadias($data_inicial,$data_final,$hour,$D);
  }else if($dias == '2'){
      $D = 'Ter';
      listadias($data_inicial,$data_final,$hour,$D);
  }else if($dias == '3'){
      $D = 'Wed';
      listadias($data_inicial,$data_final,$hour,$D);
  }else if($dias == '4'){
      $D = 'Thu';
      listadias($data_inicial,$data_final,$hour,$D);
  }else if($dias == '5'){
      $D = 'Fri';
      listadias($data_inicial,$data_final,$hour,$D);
  }else if($dias == '6'){
      $D = 'Sat';
      listadias($data_inicial,$data_final,$hour,$D);
  }
}

/////----**** 3°PARTE ****---/////

function listadias($data_inicial,$data_final,$hour,$D){

    $data_inicial 	= implode('-', array_reverse(explode('/', substr($data_inicial, 0, 10)))).substr($data_inicial, 10);
    $data_inicial 	= new DateTime($data_inicial);

    $data_final 	= implode('-', array_reverse(explode('/', substr($data_final, 0, 10)))).substr($data_final, 10);
    $data_final 	= new DateTime($data_final);

    $periodo = new DatePeriod($data_inicial, new DateInterval('P1D'), $data_final);

    foreach($periodo as $item){
        //Agora eu vou verificar o dia da semana no calendário americano, com isso verifico no meu laço para passar os parâmetro e trazer o que preciso
        if($item->format("D") == $D){
            restfim($item->format('Y-m-d'),$item->format("D"),$hour);
        }
    }
}

/////----**** 4°PARTE ****---/////

function restfim($datas,$semana,$hour){

    //pegar minha hora inicial e gerar a data final com a hora final, de acorda com a hora vindo por parâmetro,

    $hora_somada = date('H:i:s', strtotime('+60 minute', strtotime($hour)));
    $date_hore   = new DateTime();

    $hora_saida = explode(":",$hour);
    if($hora_saida[1] == '30'){
        $hora_saida_soma = explode(":",$hora_somada);
        $date_hore->setTime($hora_saida_soma[0],29,59);
        $hora_saida = $date_hore->format('H:i:s');
    }else{
        $date_hore->setTime($hora_saida[0],59,59);
        $hora_saida = $date_hore->format('H:i:s');
    }

    $start_at = $datas.' '.$hour;
    $ends_at  = $datas.' '.$hora_saida;

    echo'inicio '.$start_at.' fim '.$ends_at.' Dia da semana '.$semana;
    echo'<hr/>';
}