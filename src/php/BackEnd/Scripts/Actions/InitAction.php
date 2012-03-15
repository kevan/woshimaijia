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

class InitAction extends Action
{

	public function initTagsFromBrand()
	{
		//set startid and maxid
		$maxid = BrandLogic::getMaxId();
		$lastid = BaseService::redisGetKeyValues(KeysService::$string,KeysService::$keyLastBrandId);
		$lastid =0;// intval($lastid)>0 ? $lastid : 0;
		if($lastid<$maxid)
		{
			//获取上次操作的id
			$brands = BrandLogic::gets('brand', "status=0 and id>=$lastid and id<=$maxid",'id,title,titleextend,user_id');
			foreach ($brands as $one)
			{
				if(!empty($one['title'])){
					TagsLogic::objAndTag($one['title'], $one['id'], $one['user_id']);
				}
				
				if(!empty($one['titleextend'])){
					TagsLogic::objAndTag($one['titleextend'], $one['id'], $one['user_id']);
				}
			}
			//set maxid
			BaseService::redisSetKeyValues(KeysService::$string, KeysService::$keyLastBrandId,$maxid);
		}
		exit(0);

	}

	public function initPubActionTags()
	{
		//导入公共的用户动作文件到redis
		$file = 'PubActionTags.txt';
		$fd = fopen($file, "r");
		$line = fgets($fd);
		$i = 0;
		while ($line) {
			$array['tag'] = trim($line);
			$return = TagsService::addTags($array);
			if($return['code'] === 0){
				//写入到redis中
				$r = BaseService::redisSetKeyValues(KeysService::$ulist, KeysService::$keyPubActionTags,$return['data']);
				if(!$r){
					logNotice("ADD TAGS %s TO REDIS ERROR",$line);
				}
				$i++;
			}
			$line = fgets($fd);
		}
		logNotice('ADD %s WORDS',$i);
	}


	/**
	 * 从淘宝商城获取品牌信息
	 * 并写入到数据库中去
	 */
	public function initGetTmall()
	{
		require_cache(BUDDY_PATH.DIRECTORY_SEPARATOR."Vender/simple_html_dom.php");
		$arrUrl = array(
			'http://brand.tmall.com/tagValueIndex.htm?industryId=100',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=109',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=111',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=101',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=110',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=108',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=103',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=102',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=104',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=107',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=105',
			'http://brand.tmall.com/tagValueIndex.htm?industryId=106',
		);
		
		foreach ($arrUrl as $one)
		{
			$this->getBrandList($one);
		}
		echo "---------- INIT DONE ----------------\n";
	}
	
	public function getBrandList($url)
	{
		$dom = file_get_html($url, $use_include_path = false, $context=null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed=true, $target_charset = 'gb2312', $stripRN=true, $defaultBRText=DEFAULT_BR_TEXT);
		$str = "";
		foreach($dom->find("div.brandIndex-list") as $e)
		{
			$str .= iconv('gbk', 'utf-8', $e->outertext."\n");
		}
		$html = str_get_html($str);
		foreach ($html->find('dl') as $dl)
		{
			foreach ($dl->find('dd') as $dd)
			{
				foreach ($dd->find('a') as $a)
				{
					echo $a->href."\n";
					$r[] = $this->getBrand($a->href);
				}
			}
		}
		return true;
	}

	public function getBrand($url)
	{
		$allarr = array();
		$urlarr = array();
		//requrest
		$subUrl = file_get_html($url);
		$strSub = "";
		foreach($subUrl->find("div.brandList") as $se)
		{
			$strSub .= iconv('gbk','utf-8',$se->outertext."\n");
		}
		$subhtml = str_get_html($strSub);
		foreach ($subhtml->find('a') as $sa)
		{
			
			$title = $sa->innertext();
			preg_match("/data-ks-lazyload=\"(.*?)\" alt=\"(.*?)\"/", $title,$src);
			if(!empty($src[1]) && !empty($src[2]))
			{
				$urlarr['image_id'] = ImageService::actSave($src[1]);
				$urlarr['siteurl'] = $sa->href;
				$alt = $src[2];
				
				echo $alt."----\n";
				//(Uniqlo)
				preg_match("/\((.*?)\)/", $alt,$textend);
				if(!empty($textend[1]))
				{
					$urlarr['titleextend'] = $textend[1];
					$alt = str_replace("(".$textend[1].")", '', $alt);
				}else{
					$urlarr['titleextend'] = '';
				}
				$urlarr['title'] = $alt;
				//写入品牌数据库
				$urlarr['user_id'] = C('defaultuser');
				$urlarr['desc'] = "发布了品牌".$alt;
				//echo "--------\n";
				//var_dump($urlarr);
				//echo "---------\n";
				$result = BrandService::actAddBrand($urlarr);
				//var_dump($result);
			}
			
		}
		return $allarr;
	}

}