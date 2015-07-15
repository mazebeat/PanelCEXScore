<?php

/**
 * TipoCliente
 *
 * @property integer $id_tipo_cliente
 * @property string $descripcion_tipo_cliente
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\TipoCliente whereIdTipoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\TipoCliente whereDescripcionTipoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\TipoCliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TipoCliente whereUpdatedAt($value)
 */
class TipoCliente extends \Eloquent
{
	protected     $table      = 'tipo_cliente';
	protected     $primaryKey = 'id_tipo_cliente';
	public static $rules      = array(// 'title'            => 'required'
	);
	protected     $fillable   = array('descripcion_tipo_cliente');

}