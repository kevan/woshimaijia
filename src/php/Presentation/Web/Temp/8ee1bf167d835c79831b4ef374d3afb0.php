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
                            href="<?php echo U('login/logout');?>">退出</a><?php } ?></span></form></div></div></div><div id="wrapper"><div id="content"><h1><?php if(isset($page["head"]["title"])) { echo ($page["head"]["title"]); }  ?></h1><div class="grid-16-8 clearfix"><?php if(isset($_GET['code'])){ ?>提示:已经更新成功<?php echo isset($_GET["code"]) ? htmlspecialchars($_GET["code"],ENT_QUOTES) : "";?><br /><?php } ?><span id="result"></span></div><div class="grid-16-8 clearfix"><div class="amain"><div class="leftspace"><form action="<?php echo U('post/deal');?>" method="post" id="userreg" name="userreg"><span class="m">我的Email地址:</span><br/><input type="text" value="" maxlength="60" size="34" name="email" id="email"  require="true" datatype="email|ajax" url="<?php echo U('check/signUpCheckEmail');?>"  msg="邮箱不能为空" /><span class="attn hint" id="e_hint">请输入Email地址</span><br/><div id="e_correct"><span class="pl">用此邮箱接收确认邮件才能完成注册。</span></div><br/><span class="m">我的密码:</span><br/><input type="password" value="" maxlength="20" size="16" name="password" id="password" require="true" value="" datatype="limit" min="5" max="12" msg="密码不能为空"/><span class="attn hint" id="p_hint">请输入密码</span><br/><span class="pl">最少5个字符，请记住自己的密码。</span><br/><br/><span class="m">我的常用名:</span><br/><input type="text" value="" maxlength="15"  size="16" name="account" id="account" require="true" datatype="userName|limit|ajax" url="<?php echo U('check/signUpCheckAccount');?>" min="4" max="20" msg=" 用户名只能由数字字母组成,长度为4-20个字符" /><span class="attn hint" id="n_hint">输入常用名,<font color="red">字母数字组成</font></span><br/><span class="pl">方便大家联系</span><br/><label><input type="checkbox" name="agreement" id="agreement" require="true" datatype="require" msg="请勾选" checked="checked"/>
                我已经认真阅读并同意我是卖家的《<a target="_blank" href="<?php echo U('about/agreement');?>">使用协议</a>》。
            </label><br/><input type="hidden" name="form" value="signup" id="form"/><br/><input type="submit" value="完成注册" class="btn-submit" id="button"/></form><script>
            $('#userreg').checkForm();
        </script></div></div><div class="aside"><div class="pl"><p>><a  href="<?php echo U('login/index');?>">我注册了去登录</a></p></div><div><h2>第三方帐号登录</h2><a href="<?php echo U('login/weibo');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_wb.png' title='微博登录' class="loginimg" /></a><!-- 
<a href="<?php echo U('login/qq');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_QQ.png' title='QQ登录'  class="loginimg" /></a><br /><a href="<?php echo U('login/taobao');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_tb.gif' title='淘宝登录'  class="loginimg" /></a><a href="<?php echo U('login/qqt');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_tqq.png' title='腾讯微博登录'  class="loginimg" /></a><br /><a href="<?php echo U('login/wy');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_163.png' title='网易微博登录'  class="loginimg" /></a><a href="<?php echo U('login/renren');?>"><img src='<?php if(isset($page["resurl"])) { echo ($page["resurl"]); }  ?>/images/pics/connect_rr.gif' title='人人网登录'  class="loginimg" /></a><br />
 --></div></div><div class="extra"></div></div></div><div id="footer"><div class="fr"><a class="opt" style="margin-left: 40px;" href="#top">返回顶部</a></div><div class="gray-link"><a href="<?php echo U('about/about');?>">关于我是买家</a>|<a
			href="<?php echo U('about/joinus');?>">联系我们</a>|<a
			href="<?php echo U('about/agreement');?>">使用协议</a>|<a
			href="<?php echo U('about/help');?>">看看帮助</a> |<a id="report" style="color: #c0c0c0"
			href="javascript:void(0)" onclick="reportdanger()">举报不良信息</a> |<a
			href="http://blog.woshimaijia.com/" target="_blank">我是买家官方博客</a></div><div style="float: right" class="gray-link">		Copyright © woshimaijia.com 2010-2011 All rights reserved.<a
			target="_blank" href="http://www.miibeian.gov.cn">浙ICP备09035551号</a></div></div></div></body></html>