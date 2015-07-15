<?php

/**
 * Encuesta
 *
 * @property integer                                                           $id_encuesta
 * @property string                                                            $titulo
 * @property string                                                            $slogan
 * @property string                                                            $description
 * @property string                                                            $fecha_creacion
 * @property string                                                            $fecha_modificacion
 * @property integer                                                           $id_estado
 * @property \Carbon\Carbon                                                    $created_at
 * @property \Carbon\Carbon                                                    $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sector[]           $sectores
 * @property-read \Illuminate\Database\Eloquent\Collection|\PreguntaCabecera[] $preguntas
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereIdEncuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereTitulo($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereSlogan($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereFechaCreacion($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereFechaModificacion($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Encuesta whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cliente[] $clientes 
 */
class Encuesta extends \Eloquent
{

	public static $rules      = ['titulo'    => 'required',
	                             'slogan'    => '',
	                             'id_estado' => 'required'];
	protected     $table      = 'encuesta';
	protected     $primaryKey = 'id_encuesta';
	protected     $fillable   = ['titulo', 'slogan', 'id_estado'];

	public function clientes()
	{
		return $this->hasMany('Cliente', 'id_encuesta');
	}

	public function sectores()
	{
		return $this->belongsToMany('Sector', 'encuesta_sector', 'id_encuesta', 'id_sector');
	}

	public function preguntas()
	{
		//return $this->HasMany('PreguntaCabecera', 'id_encuesta')->orderBy('numero_pregunta', 'ASC');
		return $this->HasMany('PreguntaCabecera', 'id_encuesta');
	}
}