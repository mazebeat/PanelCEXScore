<?php

/**
 * Plan
 *
 * @property integer $id_plan 
 * @property string $descripcion_plan 
 * @property integer $id_estado 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\Plan whereIdPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\Plan whereDescripcionPlan($value)
 * @method static \Illuminate\Database\Query\Builder|\Plan whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Plan whereUpdatedAt($value)
 */
class Plan extends \Eloquent
{

	protected $table      = 'plan';
	protected $primaryKey = 'id_plan';

	// Add your validation rules here
	public static $rules = array(// 'title'            => 'required'
	);
	
	// Don't forget to fill this array
	protected $fillable = array('descripcion_plan',
	                            'id_estado',);

}