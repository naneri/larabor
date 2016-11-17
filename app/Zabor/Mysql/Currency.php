<?php namespace App\Zabor\Mysql;

class Currency extends ZaborModel
{
    protected $table = "currency";
    
    public $primaryKey = 'pk_c_code';
}
