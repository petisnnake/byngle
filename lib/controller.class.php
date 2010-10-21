<?php
class Controller
{
	protected $_controller;
	protected $_model;
	protected $_action;
	protected $_template;
	
	function __construct($model, $controller, $action)
	{
		$this->_controller = $controller;	
		$this->_model = $model;
		$this->_action = $action;
		$this->$model = new $model;
		$this->_template = new Template($controller, $action);
	}
	
	function set($name, $value)
	{
		$this->_template->set($name, $value);	
	}
	
	function __destruct()
	{
		$this->_template->render();
	}	
}