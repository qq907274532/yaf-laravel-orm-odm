<?php
	
	/**
	 * Created by PhpStorm.
	 * User: peter
	 * Date: 2016/11/25
	 * Time: 13:12
	 */
	use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
	class MongoDb extends Eloquent
	{
		public function __construct ( )
		{
			parent::__construct ( );
		}
	}