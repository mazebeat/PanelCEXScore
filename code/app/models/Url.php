<?php

/**
 * Url
 *
 * @property integer        $id
 * @property string         $given
 * @property string         $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Url whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Url whereGiven($value)
 * @method static \Illuminate\Database\Query\Builder|\Url whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Url whereUpdatedAt($value)
 * @property string $params 
 * @method static \Illuminate\Database\Query\Builder|\Url whereParams($value)
 */
class Url extends Eloquent
{
	public static $rules = array('url' => 'required|url');
	protected     $table = 'urls';

	public static function validate($input)
	{
		$v = Validator::make($input, static::$rules);

		return $v->fails() ? $v : true;
	}

	public static function getShortenedUrl()
	{
		$shortened = base_convert(rand(10000, 999999), 10, 36);
		if (static::whereGiven($shortened)->first()) {
			return static::getShortenedUrl();
		}

		return $shortened;
	}

}