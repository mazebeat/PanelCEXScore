<?php

class Tools
{

	public static function printr($a)
	{
		echo "<pre>" . htmlspecialchars(print_r($a, true)) . "</pre>";
	}
} 