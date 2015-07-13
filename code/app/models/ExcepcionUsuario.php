<?php

/**
 * ExcepcionCliente
 *
 */
class ExcepcionUsuario extends \Eloquent
{

	public static $rules      = array(// 'title'            => 'required'
	);
	protected     $table      = 'excepcion_usuario';
	protected     $primaryKey = 'id_excepcion_usuario';
	protected     $fillable   = array('id_excepcion', 'id_cliente', 'fecha');

}