<?php

/**
 * ExcepcionCliente
 *
 */
class ExcepcionCliente extends \Eloquent
{

	protected $table      = 'excepcion_cliente';
	protected $primaryKey = 'id_excepcion_cliente';

	public static $rules = array(// 'title'            => 'required'
	);
	
	protected $fillable = array('id_excepcion', 'id_cliente', 'fecha');

}