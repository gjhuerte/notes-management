<?php 

namespace App;

class Quote {
	
	public static $list = [
		"Make an empty space in any corner of your mind, and creativity will instantly fill it.",
		"I am convinced that material things can contribute a lot to making one's life pleasant, but, basically, if you do not have very good friends and relatives who matter to you, life will be really empty and sad and material things cease to be important.",
		"Thoughts without content are empty, intuitions without concepts are blind.",
		"I walk slowly into myself, through a forest of empty suits of armor.",
		"Education's purpose is to replace an empty mind with an open one.",

	];

	public static function randomize()
	{
		$i = self::generateKey();
		while(!isset(self::$list[$i]))
		{
			$i = self::generateKey();
		}

		echo self::$list[$i];
		
	}

	public static function generateKey()
	{
		return rand(0, count(self::$list));
	}


}

?>