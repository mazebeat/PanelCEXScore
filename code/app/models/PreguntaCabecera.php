<?php

/**
 * PreguntaCabecera
 *
 * @property integer $id_pregunta_cabecera 
 * @property string $descripcion_1 
 * @property string $descripcion_2 
 * @property string $descripcion_3 
 * @property string $numero_pregunta 
 * @property integer $id_pregunta_padre 
 * @property integer $id_estado 
 * @property integer $id_encuesta 
 * @property integer $id_tipo_respuesta 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Encuesta $encuesta 
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereIdPreguntaCabecera($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereDescripcion1($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereDescripcion2($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereDescripcion3($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereNumeroPregunta($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereIdPreguntaPadre($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereIdEncuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereIdTipoRespuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\PreguntaCabecera whereUpdatedAt($value)
 */
class PreguntaCabecera extends \Eloquent
{

	public static $rules      = array('descripcion_1'     => 'required',
	                                  'descripcion_2'     => 'required',
	                                  'descripcion_3'     => 'required',
	                                  'numero_pregunta'   => 'required',
	                                  'id_pregunta_padre' => 'required',
	                                  'id_tipo_respuesta' => 'required',
	                                  'id_estado'         => 'required',
	                                  'id_encuesta'       => 'required');
	protected     $table      = 'pregunta_cabecera';
	protected     $primaryKey = 'id_pregunta_cabecera';
	protected     $fillable   = array('descripcion_1',
	                                  'descripcion_2',
	                                  'descripcion_3',
	                                  'numero_pregunta',
	                                  'id_pregunta_padre',
	                                  'id_tipo_respuesta',
	                                  'id_estado',
	                                  'id_encuesta');

	public function encuesta()
	{
		return $this->belongsTo('Encuesta');
	}
}

	