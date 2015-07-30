<?php

/**
 * TipoCliente
 *
 */
class TipoCliente extends \Eloquent
{
	protected     $table      = 'tipo_cliente';
	protected     $primaryKey = 'id_tipo_cliente';
	public static $rules      = array(// 'title'            => 'required'
	);
	protected     $fillable   = array('descripcion_tipo_cliente');

}