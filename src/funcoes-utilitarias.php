<?php

function formatarPreco (float $valor):string {
    return "R$ ".number_format($valor, 2, ",", ".");
}

function totalizar ($preco, $quantidade){
    $total = $preco * $quantidade;
    return formatarPreco($total);
}
