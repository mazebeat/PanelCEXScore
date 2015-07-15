<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

/**
 * User
 *
 * @property integer $id_cliente
 * @property string $rut_cliente
 * @property string $nombre_cliente
 * @property string $fono_cliente
 * @property string $correo_cliente
 * @property string $direccion_cliente
 * @property integer $id_estado
 * @property integer $id_ciudad
 * @property integer $id_tipo_cliente
 * @property integer $id_sector
 * @property integer $id_plan
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\User whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereRutCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereNombreCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereFonoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereDireccionCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdCiudad($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdTipoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdSector($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
 * @property integer $id_usuario 
 * @property string $nombre_usuario 
 * @property string $password 
 * @property integer $edad_usuario 
 * @property string $genero_cliente 
 * @property string $desea_correo_cliente 
 * @property integer $id_tipo_usuario 
 * @method static \Illuminate\Database\Query\Builder|\User whereIdUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereNombreUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereEdadUsuario($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereGeneroCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereDeseaCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereIdTipoUsuario($value)
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
