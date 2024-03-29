<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table= 'transacciones';
    protected $primaryKey= 'idTransacciones';
    protected $foreignKey= 'idClientes';
    protected $fillable= ['tipoTransacciones', 'observacionTransacciones', 'fechaTransacciones',
    'puntosTransacciones', 'valorFinalTransacciones'. 'formaPagoTransacciones', 'plazoTransacciones',
    'estadoTransacciones'];

    public function clientes(){
        return $this->belongsTo('App\Cliente', 'idClientes');
    }
    
    
}
