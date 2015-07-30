<?php

/**
 * Link
 *
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