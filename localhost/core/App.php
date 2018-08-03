<?php

namespace Core;

use controllers\ArticleController;
use controllers\PageController;

/**
 * Identify controller or action, and return it name.
 */
class App
{
	
	protected $request;
	
	

	public function __construct(Request $request)
	{
		$this->request = $request;

		/*echo '<pre>';
		var_dump($this->getRoutByRequest());
		die;*/
	}

	public function go()
	{
		$params = $this->getRoutByRequest();
		if ($params === false){
			$params = $this->getRoutByParams('/default');
		}
		$ctrl = new $params['controller']($this->request);
		$action = $params['action'];

		$ctrl->$action();
		$ctrl->template();

	}

	private function getRoutByRequest()
	{
		return isset($this->routs()[$this->request->rout]) ? $this->routs()[$this->request->rout] : false;
	}

	private function getRoutByParams($rout)
	{
		return isset($this->routs()[$rout]) ? $this->routs()[$rout] : false;
	}

	private function routs()
	{
		return [
			'/' => [
				'controller' => 'controllers\ArticleController',
				'action' => 'indexAction',
				//'method' => 'GET',
			],
			'/article' =>[
				'controller' => 'controllers\ArticleController',
				'action' => 'oneAction',
				//'method' => 'GET',
			],
			'/add' =>[
				'controller' => 'controllers\ArticleController',
				'action' => 'addAction',
				//'method' => 'GET',
			],
			'/edit' =>[
				'controller' => 'controllers\ArticleController',
				'action' => 'editAction',
				//'method' => 'GET|POST',
			],
			'/del' =>[
				'controller' => 'controllers\ArticleController',
				'action' => 'delAction',
				//'method' => 'GET',
			],
			'/signup' =>[
				'controller' => 'controllers\UserController',
				'action' => 'signupAction',
				//'method' => 'POST',
			],
			'/login' =>[
				'controller' => 'controllers\UserController',
				'action' => 'loginAction',
				//'method' => 'POST',	
			],
			'/default' =>[
				'controller' => 'controllers\BaseController',
				'action' => 'page404',
				//'method' => 'POST',	
			],
		];
	}
}