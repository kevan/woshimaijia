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

/**
 * post预处理
 * @author xinqiyang
 *
 */
class StreamDealerLogic extends BaseLogic {

    private $_content = '';
    private $_account_id;
    private $_object_id = 0;
    private $_url_id = 0;
    private $_imageids = 0;
    private $_tagids = array();
    private $_obj_id; //objid

    public function __construct($content, $object_id, $account_id) {
        $this->_content = $content;
        $this->_account_id = $account_id;
        $this->_obj_id = $object_id;
    }

    public function tagids() {
        return $this->_tagids;
    }

    public function deal() {
        $this->clean();
        $this->_content = $this->dealUrl($this->_content);
        $this->_content = $this->dealatUser($this->_content);
        $this->_content = $this->dealPost($this->_content);
        $this->_content = $this->getFeeling($this->_content);
        return $this->_content;
    }

    //清除输入的html和js代码
    public function clean() {
        if (!empty($this->_content)) {
            $this->_content = h($this->_content);
        }

        return;
    }

    public function getObject() {
        return $this->_object_id;
    }

    public function getImageids() {
        return $this->_imageids;
    }

    /**
     * 处理这里的URL的内容
     * 这里先写入本地的URL，然后在对URL做跳转操作，可以记录点击的信息
     * @param unknown_type $content
     */
    public function dealUrl($content) {
        //正则匹配出URL 然后写入到 url表,然后
        preg_match_all("#((http|https):\/\/)?([a-z0-9_\-\/\.]+\.[][a-z0-9\:\*\;\&\#\@\=\_\~\%\?\/\.\,\+\-]+)#i", $content, $m);
        if (!empty($m[0])) {
            $m[0] = array_unique($m[0]);
            //获取是否包含有淘宝的链接或者是拍拍的链接有的话则进行处理
            foreach ($m[0] as $one) {
                //对url进行替换处理
                $urlid = UrlLogic::isExistUrl($one);
                if (empty($urlid)) {
                    $shareGoods = new ShareGoods($one);
                    //如果找到了商品则对商品进行保存，当前就支持淘宝
                    $goodid = $shareGoods->getGoodsId();
                    if (!empty($goodid)) {
                        $goodinfo = $shareGoods->getGoods();
                        //调用product
                        $array['title'] = $goodinfo['goods_name'];
                        //$gooddesc = str_replace($one, '', $content);
                        $array['account_id'] = $this->_account_id;
                        //判断商品是否存在
                        $goodexist = ProductLogic::isExist('product','title',$goodinfo['goods_name']);
                        if (!$goodexist) {
                            if (!empty($goodinfo['goods_pic'])) {
                                $array['image_id'] = ImageService::actSave($goodinfo['goods_pic']);
                                $this->_imageids = $array['image_id'];
                            }
                            $array['price'] = $goodinfo['goods_price'];
                            $array['url'] = $one;
                            $array['notdeal'] = true;
                            $r = ProductService::actAddProduct($array);
                            if($r['code'] === Error::SUCCESS){
                                $this->_object_id = $r['data']['id'];
                                $this->_url_id = $r['data']['url_id'];
                            }
                        } else {
                            //如果存在则将直接将object_id返回了
                            $this->_object_id = $goodexist['id'];
                            $this->_url_id = $goodexist['url_id'];
                        }
                    } else {
                        $arrUrl['title'] = 'posturl';
                        $arrUrl['account_id'] = $this->_account_id;
                        $arrUrl['siteurl'] = $one;
                        $urlReturn = UrlService::actAddUrl($arrUrl);
                        if ($urlReturn['code'] === Error::SUCCESS) {
                            $this->_url_id = $urlReturn['data'];
                        }
                    }
                }else{
                    $this->_url_id = $urlid['id'];
                }
                if ($this->_url_id) {
                    $urlname = U('url/url', array('id' => $this->_url_id));
                    $url = "<a href='$urlname' target='_blank'>$urlname</a>";
                    $content = str_replace($one, $url, $content);
                }
            }
        }
        return $content;
    }

    /**
     * 处理@用户的部分
     * @param unknown_type $content
     */
    public function dealatUser($content) {
        return $content;
    }

    /**
     * 处理发布的内容
     * #标题#内容的部分
     * 处理内容中的关键字部分的信息
     * @param unknown_type $content
     */
    public function dealPost($content) {
        $arrtags = array();
        preg_match_all("/#(.*?)#/u", $content, $m);
        if (!empty($m[0])) {
            foreach ($m[0] as $one) {
                $tag = str_replace('#', '', $one);
                $arrtags[] = $tag;
            }
        }
        //进行链接处理
        $dealContent = preg_replace("/\<a(.*?)\<\/a\>/", '', $content);
        $recognizeTags = TagsLogic::getWords($dealContent, 'tags');
        $arrtags = array_merge($arrtags, $recognizeTags);
        //error_log($content);
        //error_log(implode($arrtags, ','));
        if (!empty($arrtags)) {
            foreach ($arrtags as $onetag) {
                $id = TagsLogic::setObjectAndTag($onetag, $this->_obj_id, $this->_account_id);
                if ($id) {
                    //ADD TO THE KEYS
                    $this->_tagids[$id] = $id;
                    //这里得看是否在一个标签中了
                    $replace = "<a href='" . U('tag/tag', array('id' => $id)) . "' >$onetag</a>";
                    $content = str_replace($onetag, $replace, $content);
                }
            }
        }
        return $content;
    }

    /**
     * 获取用户的感情色彩
     * 判断保护了特定的感情色彩的关键词则认为是这样的情感色彩
     * @param unknown_type $content
     */
    public function getFeeling($content) {

        return $content;
    }

}