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

class MenuAction extends AppBaseAction
{
	
	public function menu()
	{
		$action = isset($_GET['action']) ? $_GET['action'] : ''; 
                //var_dump($_REQUEST);die;
		$this->assign('module',$action);
		$this->t();
	}
	
	public function topmenu()
	{
		$this->t();
	}
}

