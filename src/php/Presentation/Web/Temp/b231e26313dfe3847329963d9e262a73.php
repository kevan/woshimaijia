<?php if (!defined('BUDDY_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php if(isset($page["head"]["title"])) { echo ($page["head"]["title"]); }  ?> 我是买家</title><meta http-equiv="Pragma" content="no-cache" /><meta http-equiv="Expires" content="Sun, 6 Mar 2005 01:00:00 GMT" /><meta name="keywords" content="<?php if(isset($page["head"]["tags"])) { echo ($page["head"]["tags"]); }  ?>" /><meta name="description" content="<?php if(isset($page["head"]["desc"])) { echo ($page["head"]["desc"]); }  ?>" /><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery.min.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/common.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/validity.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/facebox.js"></script><script type="text/javascript" src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/js/jquery.qtip.js"></script><link rel="shortcut icon" href="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/favicon.ico"  type="image/x-icon" /><link href="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/css/wsmj.css" rel="stylesheet" type="text/css" /><link href="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/css/jquery.qtip.css" rel="stylesheet" type="text/css" /><script type="text/javascript">
            var uid = "<?php if(isset($page["user"]["id"])) { echo ($page["user"]["id"]); }  ?>";
            var screenname = "<?php if(isset($page["user"]["screenname"])) { echo ($page["user"]["screenname"]); }  ?>";
            var userimage = "<?php  echo (getNewImage($page["user"]["image_id"],'m'));  ?>";

            jQuery(document).ready(function($) {
                $.facebox.settings.loadingImage = '<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/facebox/loading.gif';
                $.facebox.settings.closeImage = '<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/facebox/closelabel.png';
                $('a[rel*=facebox]').facebox();
            })
        </script></head><body><div class="top-nav"><div class="bd"><div class="top-nav-logo"><a href="/" title="我是买家"><img  src="<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/nav/logos.png" alt="我是买家-买家分享社区" /></a></div><div class="top-nav-menu"><a href="<?php if(empty($page["user"]["id"])){ ?>/<?php }else{ ?><?php echo U('home/index');?><?php } ?>">首页</a><a href="<?php echo U('love');?>" >我喜欢</a><a href="<?php echo U('own');?>" >我拥有</a></div><div class="top-nav-info"><form id="grobleform" name="ssform" method="get" action="<?php echo U('search/dosearch');?>"><span><input
                                    name="search_text" title="开始搜索" type="text" size="22"
                                    maxlength="60" value="" id="good_search" autocomplete="off"
                                    class="inputline"><input type="submit" value="搜 搜"
                                                          class="btn-search"><?php if(empty($page["user"]["id"])){ ?><a href="<?php echo U('signup');?>"
                                                     title="注册">注册</a><a href="<?php echo U('login');?>" >登陆</a><?php }else{ ?><a href="<?php echo U('people/space',array('enname'=>$page['user']['account']));?>" ><img src="<?php  echo (getNewImage($page["user"]["image_id"],'m'));  ?>"  title="<?php if(isset($page["user"]["screenname"])) { echo ($page["user"]["screenname"]); }  ?>" alt="<?php if(isset($page["user"]["screenname"])) { echo ($page["user"]["screenname"]); }  ?>"  /></a><a href="<?php echo U('mail');?>">消息</a><a
                            href="<?php echo U('account/setting');?>">设置</a><a
                            href="<?php echo U('login/logout');?>">退出</a><?php } ?></span></form></div></div></div><div id="wrapper"><div id="content"><h1><?php if(isset($page["head"]["title"])) { echo ($page["head"]["title"]); }  ?></h1><div class="grid-16-8 clearfix"><?php if(isset($_GET['code'])){ ?>提示:已经更新成功<?php echo isset($_GET["code"]) ? htmlspecialchars($_GET["code"],ENT_QUOTES) : "";?><br /><?php } ?><span id="result"></span></div><div class="grid-16-8 clearfix"><div class="amain"><?php if(!empty($page['user']['id'])){ ?><div class="txd"><h2>说说......</h2><form name="form1" id="from1" method="post" action="<?php echo U('post/deal');?>"><input type="hidden" name="form" value="stream" id="form"/><textarea id="ccontents" name="content" rows="3" cols="65"></textarea><br><div><input type="button" name="mybtn" id="mybtn" onclick="postData()" value="发 送" class="btn-submit"></div></form></div><div class="clear"></div><?php } ?><?php if(!empty($page['data']['stream'])){ ?><div id="postlist"><ul class="mbt"><?php if(isset($page['data']['stream']) && is_array($page['data']['stream'])){ $i = 0; $__LIST__ = $page['data']['stream'];if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$vo){ ++$i;$mod = ($i % 2 );?><div id="reply_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"><li class="mbtl"><div onmouseout="usercheckfollow(<?php if(isset($vo['account_id'])) { echo ($vo['account_id']); }  ?>)" onmouseout="this.getElementsByTagName('div')[0].style.display = 'none'"><a
	href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo['account_id']]['account']));?>"><img
	src="<?php  echo (getNewImage($page['data']['user'][$vo['account_id']]['image_id'],'m'));  ?>"
	title="<?php if(isset($page['data']['user'][$vo['account_id']]['screenname'])) { echo ($page['data']['user'][$vo['account_id']]['screenname']); }  ?>"></a><div class="focus_<?php if(isset($vo['account_id'])) { echo ($vo['account_id']); }  ?>" style="position:relative;text-align:center"></div></div></li><li class="mbtr"><a href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo['account_id']]['account']));?>"><?php if(isset($page['data']['user'][$vo['account_id']]['screenname'])) { echo ($page['data']['user'][$vo['account_id']]['screenname']); }  ?></a><span
                        class="pl">说：</span><div class="postimg"><?php if(!empty($vo['object_id']) && !empty($vo['image_id']) ) { ?><a href="<?php echo U('object/object',array('id'=>$vo['object_id']));?>" ><img src="<?php  echo (getNewImage($vo["image_id"],'l'));  ?>" /></a><?php } ?></div><div class="quote"><span class="inq"><?php  echo (nl2br($vo["content"]));  ?></span><br /><span><a href="<?php echo U('post/post',array('id'=>$vo['id']));?>"><?php if(isset($vo["source"])) { echo ($vo["source"]); }  ?></a>&nbsp;</span><span><a
                                href="javascript:void(0)" onclick="reply('<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>')"
                                class="reply_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"  rev="unfold" rel=""><span id="replynum_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"><?php if(isset($vo["reply"])) { echo ($vo["reply"]); }  ?></span>回应</a></span><span style="margin-left: 10px;"><a
                                href="javascript:void(0)" onclick="usercopy('<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>')"
                                class="usercopy_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>" name="" rev="unfold" rel=""><span id="usercopynum_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"><?php if(isset($vo["usercopy"])) { echo ($vo["usercopy"]); }  ?></span>转发</a></span><span style="margin-left: 10px;"><?php  echo (aliasTime(msubstr($vo["id"],0,10)));  ?></span><?php if($vo['account_id'] == $page['user']['id']) { ?><span class="reply_banned"><span class="commentfright"><a rel="nofollow"
                                                                href="javascript:void(0)"
                                                                class="commentfright" onclick="clickaction('<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>','del')" title="删除">&gt;删除</a></span></span><?php } ?><div id="replynew_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"></div><div id="replylist_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"></div><br /><div id="ureply_<?php if(isset($vo["id"])) { echo ($vo["id"]); }  ?>"></div><?php if($vo['isusercopy'] == 1) { ?><div><a href="<?php echo U('object/object',array('id'=>$vo['object_id']));?>">原消息：</a><?php  echo (userCopy($vo["object_id"]));  ?></div><?php } ?></div></li></div><?php } } } ?><div class="clear"></div><div class="paginator"><?php  echo (page($page['data']['count'],$page['data']['size']));  ?></div></ul></div><?php } ?></div><div class="aside"><?php if(empty($page['user']['id'])){ ?><a href="<?php echo U('signup/index');?>" class="ulinkcss">&gt; 加入我是买家</a><br><br><a href="<?php echo U('login/index');?>" class="ulinkcss">&gt; 登陆我是买家</a><br><br><?php }else{ ?><!--
<div class="noticeblock"><a href="" class="ulinkcss" >问题报告,意见反馈</a><br /></div><div class="cat-col5"><a href="<?php echo U('input/brand');?>" class="linkcss" title="提交一个新品牌">&gt; 提交新品牌</a><br><br><a href="<?php echo U('input/product');?>" class="linkcss" title="晒晒新的产品">&gt; 晒晒新产品</a><br><br><a href="<?php echo U('input/group');?>" class="linkcss" title="新建一个小组">&gt; 新建一小组</a><br><br></div><div class="clear"></div>--><?php } ?><?php if(!empty($page['data']['accounts'])){ ?><?php if(isset($page['data']['accounts']) && is_array($page['data']['accounts'])){ $i = 0; $__LIST__ = $page['data']['accounts'];if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$vo){ ++$i;$mod = ($i % 2 );?><a href="<?php echo U('people/space',array('enname'=>$vo['account']));?>"><img src="<?php  echo (getNewImage($vo['image_id'],'s'));  ?>" title="<?php if(isset($vo['screenname'])) { echo ($vo['screenname']); }  ?>" /></a><?php } } } ?><?php } ?><div class="grayback"><h2>今天想买神马呢......</h2><div id="actions"><a href="<?php echo U('object/object',array('id'=>''));?>" class="size1" >手机</a><a href="<?php echo U('object/object',array('id'=>''));?>" class="size2">THINKPAD</a><a href="<?php echo U('object/object',array('id'=>''));?>" class="size3">电脑</a><a href="<?php echo U('object/object',array('id'=>''));?>" class="size4">Ipad3</a><a href="<?php echo U('object/object',array('id'=>''));?>" class="size5">Iphone 4s</a></div></div><?php if(!empty($page['data']['befollowids'])){ ?><h2 class="bold">
			关注我的大家 ...(<a href="<?php echo U('total/index',array('id'=>$page['user']['id'],'type'=>'befollow'));?>">全部</a>)
		</h2><div id="ownlist" class="mt5"><?php if(isset($page['data']['befollowids']) && is_array($page['data']['befollowids'])){ $i = 0; $__LIST__ = $page['data']['befollowids'];if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$vo){ ++$i;$mod = ($i % 2 );?><dl class="oblock"><dt><div onmouseout="usercheckfollow(<?php if(isset($vo)) { echo ($vo); }  ?>)"
			onmouseout="this.getElementsByTagName('div')[0].style.display = 'none'"><a
				href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo]['account']));?>"><img
				src="<?php  echo (getNewImage($page['data']['user'][$vo]['image_id'],'m'));  ?>"
				title="<?php if(isset($page['data']['user'][$vo]['screenname'])) { echo ($page['data']['user'][$vo]['screenname']); }  ?>"></a><div class="focus_<?php if(isset($vo)) { echo ($vo); }  ?>"
				style="position: relative; text-align: center"></div></div></dt><dd><a
			href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo]['account']));?>"><?php if(isset($page['data']['user'][$vo]['screenname'])) { echo ($page['data']['user'][$vo]['screenname']); }  ?></a><br />(<?php  echo (getCity($page['data']['user'][$vo]['city']));  ?>)

	</dd></dl><?php } } } ?></div><div class="clear"></div><?php } ?><?php if(!empty($page['data']['followids'])){ ?><h2 class="bold">
			我关注的大家 ...(<a href="<?php echo U('total/index',array('id'=>$page['user']['id'],'type'=>'follow'));?>">全部</a>)
		</h2><div id="ownlist" class="mt5"><?php if(isset($page['data']['followids']) && is_array($page['data']['followids'])){ $i = 0; $__LIST__ = $page['data']['followids'];if( count($__LIST__)==0 ) { echo "" ; }else{ foreach($__LIST__ as $key=>$vo){ ++$i;$mod = ($i % 2 );?><dl class="oblock"><dt><div onmouseout="usercheckfollow(<?php if(isset($vo)) { echo ($vo); }  ?>)"
			onmouseout="this.getElementsByTagName('div')[0].style.display = 'none'"><a
				href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo]['account']));?>"><img
				src="<?php  echo (getNewImage($page['data']['user'][$vo]['image_id'],'m'));  ?>"
				title="<?php if(isset($page['data']['user'][$vo]['screenname'])) { echo ($page['data']['user'][$vo]['screenname']); }  ?>"></a><div class="focus_<?php if(isset($vo)) { echo ($vo); }  ?>"
				style="position: relative; text-align: center"></div></div></dt><dd><a
			href="<?php echo U('people/space',array('enname'=>$page['data']['user'][$vo]['account']));?>"><?php if(isset($page['data']['user'][$vo]['screenname'])) { echo ($page['data']['user'][$vo]['screenname']); }  ?></a><br />(<?php  echo (getCity($page['data']['user'][$vo]['city']));  ?>)

	</dd></dl><?php } } } ?></div><div class="clear"></div><?php } ?></div><div class="extra"></div></div></div><div id="footer"><div class="fr"><a class="opt" style="margin-left: 40px;" href="#top">返回顶部</a></div><div class="gray-link"><a href="<?php echo U('about/about');?>">关于我是买家</a>|<a
			href="<?php echo U('about/joinus');?>">联系我们</a>|<a
			href="<?php echo U('about/agreement');?>">使用协议</a>|<a
			href="<?php echo U('about/help');?>">看看帮助</a> |<a id="report" style="color: #c0c0c0"
			href="javascript:void(0)" onclick="reportdanger()">举报不良信息</a> |<a
			href="http://blog.woshimaijia.com/" target="_blank">我是买家官方博客</a></div><div style="float: right" class="gray-link">		Copyright © woshimaijia.com 2010-2011 All rights reserved.<a
			target="_blank" href="http://www.miibeian.gov.cn">浙ICP备09035551号</a></div></div></div></body></html>