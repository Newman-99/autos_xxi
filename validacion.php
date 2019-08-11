<?php
function val_date($dato){
    
    // Comprobar Variable definida o vacia
    if(!isset($dato) || empty($dato) || preg_match('/\s/', $dato)){

        return true;

    } else{
            return false;
        }    
    
    }
?>