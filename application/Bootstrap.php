<?php
/**
 * @name Bootstrap
 * @author peter
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract{

	private $_config;
	
    public function _initConfig() {
		//把配置保存起来
		$this->_config = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $this->_config);
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		//注册一个插件
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}
	//初始化Eloquent Orm Odm
	public function _initEloquentORM(){
		
		Yaf_Loader::import("vendor/autoload.php");
		$capsule = new \Illuminate\Database\Capsule\Manager();
		
//		echo '<pre>';
//		var_dump( $this->_config->orm->eloquent->toArray());
//		exit;
		
		
		$capsule->getDatabaseManager()->setDefaultConnection(
			$this->_config->orm->db->default
		);
		$capsule->addConnection(
			$this->_config->orm->eloquent->toArray());
		
		$capsule->getDatabaseManager()->extend('mongodb', function($config)
		{
			return new \Jenssegers\Mongodb\Connection($config);
		});
		
		
		$capsule->bootEloquent();
		
		$capsule->setAsGlobal();
		
	}
	public function _initRoute(Yaf_Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
	}
	
	public function _initView(Yaf_Dispatcher $dispatcher){
		//在这里注册自己的view控制器，例如smarty,firekylin
	}
}
