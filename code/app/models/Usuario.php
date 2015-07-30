<?php

/**
 * Usuario
 *
 * @property integer $id_usuario 
 * @property string $nombre_usuario 
 * @property string $password 
 * @property integer $edad_usuario 
 * @property string $genero_cliente 
 * @property string $correo_cliente 
 * @property string $desea_correo_cliente 
 * @property integer $id_tipo_usuario 
 * @property integer $id_cliente 
 * @property string $remember_token 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereIdUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereNombreUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereEdadUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereGeneroCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereDeseaCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereIdTipoUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereUpdatedAt($value)
 */
class Usuario extends \Eloquent
{

	protected $table      = 'usuario';
	protected $primaryKey = 'id_usuario';

	// Add your validation rules here
	public static $rules = array(// 'title'            => 'required'
	);
	
	// Don't forget to fill this array
	protected $fillable = array('nombre_usuario',
	                            'edad_usuario',
	                            'genero_cliente',
	                            'correo_cliente',
	                            'informacion_cliente',
	                            'desea_correo_cliente',
	                            'id_tipo_cliente');



}