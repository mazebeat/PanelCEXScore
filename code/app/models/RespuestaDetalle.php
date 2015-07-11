<?php

/**
 * RespuestaDetalle
 *
 * @property integer $id_respuesta_detalle 
 * @property integer $valor1 
 * @property string $valor2 
 * @property integer $id_respuesta 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereIdRespuestaDetalle($value)
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereValor1($value)
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereValor2($value)
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereIdRespuesta($value)
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\RespuestaDetalle whereUpdatedAt($value)
 */
class RespuestaDetalle extends \Eloquent
{
	protected $table      = 'respuesta_detalle';
	protected $primaryKey = 'id_respuesta_detalle';
	protected $fillable   = array('valor1',
	                              'valor2',
	                              'id_respuesta');

}