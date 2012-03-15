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
 * 品牌服务接口，这个文件与前端交互
 * @author xinqiyang
 *
 */
class BrandService {

    public static function actAddBrand($array) {
        $data = '';
        $code = Error::PARAM_ERROR;
        if (!empty($array['title']) && !empty($array['account_id']) && !empty($array['siteurl'])) {
            extract($array);
            $source = !empty($source) ? $source : 'web';
            $enname = !empty($enname) ? $enname : '';
            $image_id = !empty($image_id) ? $image_id : 0;
            $urlResult = UrlLogic::setUrl($title,$siteurl,$account_id,$image_id);
            $url_id = $urlResult['code'] === Error::SUCCESS ? $urlResult['data'] : 0;
            $r = BrandLogic::setBrand($title,  $account_id, $url_id,$enname, $image_id);
            $code = $r['code'];
            $data = $r['data'];
        }
        return array('code' => $code, 'data' => $data);
    }

    public static function actSaveBrandImage($array) {
        $code = Error::PARAM_ERROR;
        if (!empty($array['id']) && !empty($array['user_id']) && !empty($array['image_id'])) {
            extract($array);
            $r = BrandLogic::saveBrandImage($id, $user_id, $image_id);
            if ($r) {
                $code = Error::SUCCESS;
                return array('code' => $code, 'enname' => $r);
            }
        }
        return array('code' => $code, 'enname' => '');
    }

    public static function dataBrand($array) {
        if (!empty($array['enname']) || !empty($array['id'])) {
            extract($array);
            if (intval($enname) > 0) {
                $id = $enname;
            }
            if (!empty($enname) && ($enname !== ':enname') && !$id) {
                $r = BrandLogic::getBrandByEnname($enname);
            } elseif (!empty($id)) {
                $r = BrandLogic::get('brand', $id);
            }


            if (!empty($r['id'])) {
                if (!empty($r['titleextend'])) {
                    $r['title'] = $r['title'] . ' ' . $r['titleextend'];
                }
                $id = $r['id'];
                $p = isset($p) && $p >= 1 ? $p : 1;
                $pageSize = 10;
                $postList = self::redisGetKeyValues(KeysService::$list, KeysService::$keyPost, $id, $p, $pageSize);
                $ids = empty($postList) ? '' : '(' . rtrim(implode($postList, ','), ',') . ')';
                //取得结果
                $r['count'] = self::redisGetKeyValues('', KeysService::$size, KeysService::getKey(KeysService::$list, KeysService::$keyPost, $id));
                //var_dump($r['count']);
                $r['size'] = $pageSize;
                $r['post'] = PostLogic::getPostByIds($ids);

                //获取买过的用户
                $r['likeids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyLike, $id, 0, 5);
                //获取已买的用户
                $r['ownids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyOwn, $id, 0, 5);
                //获取想买的
                $r['willbuyids'] = self::redisGetKeyValues(KeysService::$ulist, KeysService::$keyWillBuy, $id, 0, 4);
                $r['topcomments'] = BrandLogic::getTopComments($id);

                //获取数字
                $r['likenum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyLike, '', $id));
                $r['ownnum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyOwn, '', $id));
                $r['willbuynum'] = self::redisGetKeyValues(KeysService::$size, KeysService::getKey(KeysService::$ulist, KeysService::$keyWillBuy, '', $id));

                //获取所有的ID然后去取对象
                $ids = array_merge($r['ownids'], $r['likeids'], arrToOne($r['post'], 'user_id'), array($r['user_id']));
                $r['user'] = AccountLogic::getUsers($ids, 'user_id');
                return $r;
            }
        }
        return false;
    }

    public static function actAddBrandPost($array) {
        $code = Error::PARAM_ERROR;
        $r = '';
        if (!empty($array['user_id']) && !empty($array['content']) && !empty($array['object_id'])) {
            extract($array);
            $r = BrandLogic::addBrandPost($content, $user_id, $object_id);
            if ($r) {
                $return = self::redisSetKeyValues(KeysService::$list, KeysService::$keyPost, $r, $object_id);
                $r = $object_id;
                $code = Error::SUCCESS;
            } else {
                $code = Error::BUSY;
            }
        }
        return array('code' => $code, 'id' => $r);
    }

}