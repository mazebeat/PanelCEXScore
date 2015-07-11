<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

/**
 * Cliente
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Apariencia[] $apariencias 
 * @property-read \Sector $sector 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Respuesta[] $respuestas 
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereRutCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereNombreCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereFonoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereCorreoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereDireccionCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdCiudad($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdTipoCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdSector($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereIdPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Cliente whereUpdatedAt($value)
 */
class Cliente extends \Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	public static $rules = array('rut_cliente'          => 'required',
	                             'nombre_cliente'       => 'required',
	                             'fono_cliente'         => 'required',
	                             'correo_cliente'       => 'required',
	                             'direccion_cliente'    => 'required',
	                             'informacion_cliente'  => 'required',
	                             'desea_correo_cliente' => 'required',
	                             'id_estado'            => 'required',
	                             'id_ciudad'            => 'required',
	                             'id_tipo_cliente'      => 'required',
	                             'id_sector'            => 'required',
	                             'id_apariencia'        => 'required',
	                             'id_plan'              => 'required',);

	protected $table      = 'cliente';
	protected $primaryKey = 'id_cliente';
	protected $fillable   = array('rut_cliente',
	                              'nombre_cliente',
	                              'fono_cliente',
	                              'correo_cliente',
	                              'direccion_cliente',
	                              'informacion_cliente',
	                              'desea_correo_cliente',
	                              'id_estado',
	                              'id_ciudad',
	                              'id_tipo_cliente',
	                              'id_sector',
	                              'id_apariencia',
	                              'id_plan',);

	public function apariencias()
	{
		return $this->belongsToMany('Apariencia', 'cliente_apariencia', 'id_cliente', 'id_apariencia');
	}

	public function sector()
	{
		return $this->belongsTo('Sector', 'id_sector');
	}

	public function respuestas()
	{
		return $this->belongsToMany('Respuesta', 'cliente_respuesta', 'id_cliente', 'id_respuesta');
	}

	public function preguntas()
	{
		return $this->hasManyThrough('Sector', 'Encuesta', 'id_sector', 'id_encuesta');
	}}
