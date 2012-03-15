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

class IoAction extends AppBaseAction
{
	
	public function editfield()
	{
		$code = Error::PARAM_ERROR;
		$data  = '';
		if(!empty($_POST['id']) && !empty($_POST['val']) && !empty($_POST['field']))
		{
			extract($_POST);
			$where = "id=".$id;
			$object = BaseLogic::queryField('object', $where, 'object');
			$arr = array();
			$arr[$field] = $val;
			$arr['id'] = $id;
			$r = BaseLogic::saveClean($object, $arr);
			if($r){
				$data = $val;
				$code = Error::SUCCESS;
			}	
		}
		$this->ajaxReturn($data,'',$code);
	}
}