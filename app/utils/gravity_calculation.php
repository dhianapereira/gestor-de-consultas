<?php
    function gravityCalculation($percentage){
        if($percentage==0){
            return "Inexistente";
        }
        else if($percentage <= 25 && $percentage > 0){
            return "Baixa";
        }
        else if($percentage > 25 && $percentage <= 50){
            return "Média";
        }
        else if($percentage > 50 && $percentage <= 75){
            return "Alta";
        }
        else{
            return "Muito alta";
        }
    }
?>