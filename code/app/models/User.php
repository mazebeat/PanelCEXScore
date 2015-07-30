<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

/**
 * User
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
 * @property-read \Cliente $cliente 
 * @method static \Illuminate\Database\Query\Builder|\User whereIdUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereNombreUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereEdadUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereGeneroCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereDeseaCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdTipoUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
 */
class User extends Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;
	protected $table  = 'usuario';
	protected $primaryKey = 'id_usuario';
	protected $hidden = array('password',
	                          'remember_token');

	public function cliente() {
		return $this->belongsTo('Cliente', 'id_cliente');
	}

}
