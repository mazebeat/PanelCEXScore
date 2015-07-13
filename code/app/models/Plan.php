<?php

/**
 * Plan
 *
 * @property integer        $id_plan
 * @property string         $descripcion_plan
 * @property integer        $id_estado
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

	public static $rules = array(// 'title'            => 'required'
	);
	protected     $table = 'plan';

	// Add your validation rules here
	protected $primaryKey = 'id_plan';
	
	// Don't forget to fill this array
	protected $fillable = array('descripcion_plan',
	                            'id_estado',);

	public function clientes()
	{
		return $this->hasMany('Cliente', 'id_plan');
	}
}