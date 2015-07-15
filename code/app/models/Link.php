<?php

/**
 * Link
 *
 * @property integer $id_link
 * @property string $descripcion_link
 * @property string $url_link
 * @property string $url_corta
 * @property integer $id_sector
 * @property integer $id_canal
 * @property integer $id_cliente
 * @property integer $id_estado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Link whereIdLink($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereDescripcionLink($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereUrlLink($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereUrlCorta($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereIdSector($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereIdCanal($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereIdCliente($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereIdEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Link whereUpdatedAt($value)
 */
class Link extends \Eloquent
{

	protected     $table      = 'link';
	protected     $primaryKey = 'id_link';
	public static $rules      = array(// 'title'            => 'required'
	);
	protected     $fillable   = array('descripcion_link',
	                                  'url_link',
	                                  'url_corta',
	                                  'id_sector',
	                                  'id_canal',
	                                  'id_cliente',
	                                  'id_estado');

}