<?php

/**
 * Momento
 *
 * @property integer $id_momento 
 * @property string $descripcion_momento 
 * @property string $medicion 
 * @property integer $id_estado 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\Momento whereIdMomento($value)
 * @method static \Illuminate\Database\Query\Builder|\Momento whereDescripcionMomento($value)
 * @method static \Illuminate\Database\Query\Builder|\Momento whereMedicion($value)
 * @method static \Illuminate\Database\Query\Builder|\Momento whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Momento whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Momento whereUpdatedAt($value)
 */
class Momento extends \Eloquent
{

	protected     $table      = 'momento';
	protected     $primaryKey = 'id_momento';
	public static $rules      = array(// 'title'            => 'required'
	);
	protected     $fillable   = array('descripcion_momento',
	                                  'medicion',
	                                  'id_estado',);
}