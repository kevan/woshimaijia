<?php
// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

class AccountAction extends AppBaseAction
{

	public function index()
	{
		$this->t();
	}
	
	public function user()
	{
		if(!empty($_GET['p'])){
			$p = intval($_GET['p']);
		}
		$p = isset($p) && $p>=1 ? $p : 1;
		$pageSize = 15;
		$arr['data']['data']['account'] = AccountLogic::getsByPage('account', " id>0 ORDER BY ID DESC ", $p,$pageSize);
		$arr['data']['data']['size'] = $pageSize;
		$arr['data']['data']['count'] = StatService::getObjectCounts('account');
		$this->t($arr);
	}
	
	public function admin()
	{
		if(!empty($_GET['p'])){
			$p = intval($_GET['p']);
		}
		$p = isset($p) && $p>=1 ? $p : 1;
		$pageSize = 15;
		$arr['data']['data']['account'] = BaseLogic::getsByPage('services', " id>0 ORDER BY ID DESC ", $p,$pageSize);
		$arr['data']['data']['size'] = $pageSize;
		$arr['data']['data']['count'] = StatService::getObjectCounts('services');
		$this->t($arr,'Account/user');
	}
	
	
	
}