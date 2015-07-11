<?php

/**
 * Ciudad
 *
 * @property integer $id_ciudad 
 * @property integer $id_region 
 * @property string $descripcion_ciudad 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\Ciudad whereIdCiudad($value)
 * @method static \Illuminate\Database\Query\Builder|\Ciudad whereIdRegion($value)
 * @method static \Illuminate\Database\Query\Builder|\Ciudad whereDescripcionCiudad($value)
 * @method static \Illuminate\Database\Query\Builder|\Ciudad whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ciudad whereUpdatedAt($value)
 */
class Ciudad extends \Eloquent
{
	protected     $table      = 'ciudad';
	protected     $primaryKey = 'id_ciudad';
	public static $rules      = array('descripcion_ciudad' => 'required', 'id_region' => 'required',);
	protected     $fillable   = array('descripcion_ciudad', 'id_region');
}