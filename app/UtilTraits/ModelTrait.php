<?php  
namespace App\UtilTraits;
/**
 * Usefull functions in traits
 */
trait ModelTrait
{
    //funciona cuando llamas al modelo desde blade cuando lo llamas desde json o algo serializado toca agregarlo al appends
    
    public function getStateAttribute($value){
        return $value?'Activo':'Inactivo';
    }
}

?>