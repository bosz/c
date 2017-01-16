<?php
	namespace App\Libs;

	/**
	* Custom code
	*/
	class Custom
	{
		
		function __construct()
		{
			
		}

		public static function makePostURL($post_id, $post_content)
		{
			$post_content = strip_tags($post_content);
			$init = substr($post_content, 0, 60);
			$init = trim($init);
			$snakeCase = str_replace(' ', '-', $init);
			$final = $snakeCase . '_' . $post_id;
			return $final;
		}
	}

