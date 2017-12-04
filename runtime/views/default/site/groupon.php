<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->_siteConfig->name;?></title>
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/index.css";?>" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src='<?php echo $this->getWebViewPath()."javascript/site.js";?>'></script>
	<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>'></script>
</head>
<body class="index">
<div class="container">
	<div class="header">
		<h1 class="logo"><a title="<?php echo $this->_siteConfig->name;?>" style="background:url(<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."images/front/logo.gif";?><?php }?>) center no-repeat;background-size:contain;" href="<?php echo IUrl::creatUrl("");?>"><?php echo $this->_siteConfig->name;?></a></h1>
		<ul class="shortcut">
			<li class="first"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/ucenter/order");?>">我的订单</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/simple/seller");?>">申请开店</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/seller/index");?>">商家管理</a></li>
			<li class='last'><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
		</ul>
		<p class="loginfo">
			<?php if($this->user){?>
			<?php echo $this->user['username'];?>您好，欢迎您来到<?php echo $this->_siteConfig->name;?>购物！[<a href="<?php echo IUrl::creatUrl("/simple/logout");?>" class="reg">安全退出</a>]
			<?php }else{?>
			<?php
			    date_default_timezone_set("PRC");  
			    echo '<div id="time"></div>  
			    <script type="text/javascript">  
			        var dayNames = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");  
			            function get_obj(time){  
			                return document.getElementById(time);  
			            }  
			            var ts='.(round(microtime(true)*1000)).';  
			            function getTime(){  
			                var t=new Date(ts);  
			                with(t){  
			                    var _time=""+getFullYear()+"-" + (getMonth()+1)+"-"+getDate()+" " + (getHours()<10 ? "0" :"") + getHours() + ":" + (getMinutes()<10 ? "0" :"") + getMinutes() + ":" + (getSeconds()<10 ? "0" :"") + getSeconds() + " " + dayNames[t.getDay()];  
			                }  
			                get_obj("time").innerHTML=_time;  
			                setTimeout("getTime()",1000);  
			                ts+=1000;  
			            }  
			            getTime();  
			    </script>';  
			?>
			[<a href="<?php echo IUrl::creatUrl("/simple/login");?>">登录</a>|<a class="reg" href="<?php echo IUrl::creatUrl("/simple/reg");?>">免费注册</a>]
			<?php }?>
		</p>
	</div>
	<div class="navbar">
		<ul>
			<li><a href="<?php echo IUrl::creatUrl("/site/index");?>">首页</a></li>
			<?php foreach(Api::run('getGuideList') as $key => $item){?>
			<li><a href="<?php echo IUrl::creatUrl("".$item['link']."");?>"><?php echo isset($item['name'])?$item['name']:"";?><span> </span></a></li>
			<?php }?>
		</ul>

		<div class="mycart" name="mycart">
			<dl>
				<dt><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">购物车<b name="mycart_count">0</b>件</a></dt>
				<dd><a href="<?php echo IUrl::creatUrl("/simple/cart");?>">去结算</a></dd>
			</dl>

			<!--购物车浮动div 开始-->
			<div class="shopping" id='div_mycart' style='display:none;'></div>
			<!--购物车浮动div 结束-->

			<!--购物车模板 开始-->
			<script type='text/html' id='cartTemplete'>
			<dl class="cartlist">
				<%for(var item in goodsData){%>
				<%var data = goodsData[item]%>
				<dd id="site_cart_dd_<%=item%>">
					<div class="pic f_l"><img width="55px" height="55px" src="<%=webroot(data['img'])%>"></div>
					<h3 class="title f_l"><a href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>"><%=data['name']%></a></h3>
					<div class="price f_r t_r">
						<b class="block">￥<%=data['sell_price']%> x <%=data['count']%></b>
						<input class="del" type="button" value="删除" onclick="removeCart('<%=data['id']%>','<%=data['type']%>');$('#site_cart_dd_<%=item%>').hide('slow');" />
					</div>
				</dd>
				<%}%>

				<dd class="static"><span>共<b name="mycart_count"><%=goodsCount%></b>件商品</span>金额总计：<b name="mycart_sum">￥<%=goodsSum%></b></dd>

				<%if(goodsData){%>
				<dd class="static">
					<label class="btn_orange"><input type="button" value="去购物车结算" onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/cart");?>';" /></label>
				</dd>
				<%}%>
			</dl>
			</script>
			<!--购物车模板 结束-->
		</div>
	</div>

	<div class="searchbar">
		<div class="allsort">
			<a href="javascript:void(0);">全部商品分类</a>

			<!--总的商品分类-开始-->
			<ul class="sortlist" id='div_allsort' style='display:none'>
				<?php foreach(Api::run('getCategoryListTop') as $key => $first){?>
				<li>
					<h2><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>"><?php echo isset($first['name'])?$first['name']:"";?></a></h2>

					<!--商品分类 浮动div 开始-->
					<div class="sublist" style='display:none'>
						<div class="items">
							<strong>选择分类</strong>
							<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$first['id'])) as $key => $second){?>
							<dl class="category selected">
								<dt>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a>
								</dt>

								<dd>
									<?php foreach(Api::run('getCategoryByParentid',array('#parent_id#',$second['id'])) as $key => $third){?>
									<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$third['id']."");?>"><?php echo isset($third['name'])?$third['name']:"";?></a>|
									<?php }?>
								</dd>
							</dl>
							<?php }?>
						</div>
					</div>
					<!--商品分类 浮动div 结束-->
				</li>
				<?php }?>
			</ul>
			<!--总的商品分类-结束-->
		</div>

		<div class="searchbox">
			<form method='get' action='<?php echo IUrl::creatUrl("/");?>'>
				<input type='hidden' name='controller' value='site' />
				<input type='hidden' name='action' value='search_list' />
				<input class="text" type="text" name='word' autocomplete="off" value="" placeholder="请输入关键词..."  />
				<input class="btn" type="submit" value="商品搜索" />
			</form>
		</div>

		<div class="hotwords">热门搜索：
			<?php foreach(Api::run('getKeywordList') as $key => $item){?>
			<?php $tmpWord = urlencode($item['word']);?>
			<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>"><?php echo isset($item['word'])?$item['word']:"";?></a>
			<?php }?>
		</div>
	</div>
	<?php echo Ad::show("页面顶部通栏广告条960*70(default)");?>

	<div class="position"> <span>您当前的位置：</span> <a href="<?php echo IUrl::creatUrl("");?>"> 首页</a> » 团购 </div>
<div class="groupon wrapper clearfix">
	<div class="sidebar f_r">
		<div class="box org_box m_10">
			<div class="title">每天订阅团购信息<span></span></div>
			<div class="cont clearfix">
				<p>请输入您的邮箱地址</p>
				<input type="text" name='orderinfo' class="gray_m" placeholder="请输入邮箱...">
				<label class="btn_orange f_r"><input type="button" value="立即订阅" onclick="orderinfo();"></label>
			</div>
			<span class="l"></span><span class="r"></span><span class="b_l"></span><span class="b_r"></span>
		</div>
		<div class="box">
			<div class="title">往期精彩团购<span></span></div>

			<div class="cont">
				<ul class="prolist clearfix">
					<?php foreach($this->ever_list as $key => $item){?>
					<li>
						<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>"><img width="145" alt="<?php echo isset($item['title'])?$item['title']:"";?>" src="<?php echo IUrl::creatUrl("".$item['img']."");?>"></a>
						<p class="pro_title"><a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>" class="blue"><?php echo isset($item['title'])?$item['title']:"";?></a></p>
						<p>原&nbsp;&nbsp;价：<s>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></s></p>
						<p class="orange">团购价：￥<?php echo isset($item['regiment_price'])?$item['regiment_price']:"";?></p>
						<p class="red2">销量：<?php echo isset($item['sum_count'])?$item['sum_count']:"";?></p>
					</li>
					<?php }?>
					<li class="more"><a class="blue" href="<?php echo IUrl::creatUrl("/site/groupon_list");?>">更多团购>></a></li>
				</ul>
			</div>
			<span class="l"></span><span class="r"></span><span class="b_l"></span><span class="b_r"></span>
		</div>
	</div>
	<div class="main f_l t_r">
		<?php $countNumItems = array();?>
		<?php foreach($this->regiment_list as $key => $item){?>
		<?php $countNumItems[] = $item['id'];?>
		<div class="gt_box">
			<div class="grounpon_title box">
				<strong><?php echo $key+1;?> <span>今日团购</span></strong>
				<span class="l"></span><span class="r"></span>
			</div>
		</div>

		<div class="shadow_box m_10 clearfix">
			<div class="cont clearfix">
				<h1 class="g_title"><a href="<?php echo IUrl::creatUrl("/site/groupon/id/".$item['id']."");?>"><?php echo isset($item['title'])?$item['title']:"";?></a></h1>
				<div class="l_part">
					<div class="g_price m_10">
						<?php if($item['store_nums'] > $item['sum_count']){?>
						<div class="price_tag">
							<p>仅售<strong><?php echo isset($item['regiment_price'])?$item['regiment_price']:"";?></strong></p>
							<a class="buy" href="<?php echo IUrl::creatUrl("/site/products/promo/groupon/id/".$item['goods_id']."/active_id/".$item['id']."");?>">购买</a>
						</div>
						<?php }else{?>
						<div class="price_tag disabled">
							<p>仅售<strong><?php echo isset($item['regiment_price'])?$item['regiment_price']:"";?></strong></p>
							<a class="buy" href="javascript:void(0)">结束</a>
						</div>
						<?php }?>
					</div>
					<div class="orange_box m_10">
						<table class="t_c">
							<col width="85px" />
							<col width="50px" />
							<col width="85px" />
							<tbody>
								<tr><th class="normal">原价</th><th class="normal">折扣</th><th class="normal">节省</th></tr>
								<tr class="bold">
									<td><s>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></s></td>
									<td><?php echo Util::discount($item['sell_price'],$item['regiment_price']);?></td>
									<td>￥<?php echo $item['sell_price']-$item['regiment_price'];?></td>
								</tr>
							</tbody>
						</table>
					</div>

					<?php if($item['store_nums'] > $item['sum_count']){?>
					<div class="orange_box">
						<p>团购倒计时：</p>
						<?php $free_time=strtotime($item['end_time'])-ITime::getNow();?>
						<p class="t_c f14"><span id="cd_hour_<?php echo isset($item['id'])?$item['id']:"";?>" class="red2 bold"><?php echo floor($free_time/3600);?></span>小时<span id="cd_minute_<?php echo isset($item['id'])?$item['id']:"";?>" class="red2 bold"><?php echo floor( ($free_time%3600)/60 );?></span>分钟<span id="cd_second_<?php echo isset($item['id'])?$item['id']:"";?>" class="red2 bold"><?php echo $free_time%60;?></span>秒</p>
					</div>
					<div class="orange_box g_num">
						<p class="t_c">
							销量<span class="red2 bold"><?php echo isset($item['sum_count'])?$item['sum_count']:"";?></span>
							仅剩<span class="red2 bold"><?php echo $item['store_nums']-$item['sum_count'];?></span>
						</p>
					</div>
					<div class="orange_box g_num m_10">
						<p class="t_c">
							限购量：<?php echo isset($item['limit_min_count'])?$item['limit_min_count']:"";?> ~ <?php echo isset($item['limit_max_count'])?$item['limit_max_count']:"";?>
						</p>
					</div>
					<div class="dot_box t_c">数量有限，请密切关注！</div>
					<?php }else{?>
					<div class="orange_box">
						<p class="t_c">本次团购的商品已售尽！</p>
						<p class="t_c">销售量<span class="red2 bold"><?php echo isset($item['sum_count'])?$item['sum_count']:"";?></span></p>
					</div>
					<?php }?>
				</div>

				<div class="r_part box">
					<img class="g_pic" width="480" src="<?php echo IUrl::creatUrl("".$item['img']."");?>">
					<div class="g_digest clearfix"><?php echo isset($item['intro'])?$item['intro']:"";?><a class="g_btn f_r" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>">查看商品详情</a></div>
				</div>
			</div>
			<span class="l"></span><span class="r"></span><span class="b_l"></span><span class="b_r"></span>
		</div>
		<?php }?>
		<div class="g_notice box">
		<h3>团购须知：</h3>
		<p>1、因机会有限下单成功后必须立即支付。</p>
		<p>2、每个团购活动都有库存量或者购买限制。</p>
		</div>
	</div>
</div>

<script language="javascript">
$(function()
{
	//倒计时
	var cd_timer = new countdown();
	<?php foreach($countNumItems as $key => $item){?>
		cd_timer.add(<?php echo isset($item)?$item:"";?>);
	<?php }?>
});

//电子邮件订阅
function orderinfo()
{
	var email = $('[name="orderinfo"]').val();
	if(email == '')
	{
		alert('请填写正确的email地址');
	}
	else
	{
		$.getJSON('<?php echo IUrl::creatUrl("/site/email_registry");?>',{email:email},function(content){
			if(content.isError == false)
			{
				alert('订阅成功');
				$('[name="orderinfo"]').val('');
			}
			else
				alert(content.message);
		});
	}
}
</script>

	<div class="help m_10">
		<div class="cont clearfix">
			<?php foreach(Api::run('getHelpCategoryFoot') as $key => $helpCat){?>
			<dl>
     			<dt><a href="<?php echo IUrl::creatUrl("/site/help_list/id/".$helpCat['id']."");?>"><?php echo isset($helpCat['name'])?$helpCat['name']:"";?></a></dt>
				<?php foreach(Api::run('getHelpListByCatidAll',array('#cat_id#',$helpCat['id'])) as $key => $item){?>
					<dd><a href="<?php echo IUrl::creatUrl("/site/help/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dd>
				<?php }?>
      		</dl>
      		<?php }?>
		</div>
	</div>
	<?php echo IFilter::stripSlash($this->_siteConfig->site_footer_code);?>
</div>

<script type='text/javascript'>
$(function()
{
	//搜索框填充默认数据
	$('input:text[name="word"]').val("<?php echo $this->word;?>");

	var allsortLateCall = new lateCall(200,function(){$('#div_allsort').show();});

	//商品分类
	$('.allsort').hover(
		function(){
			allsortLateCall.start();
		},
		function(){
			allsortLateCall.stop();
			$('#div_allsort').hide();
		}
	);
	$('.sortlist li').each(
		function(i)
		{
			$(this).hover(
				function(){
					$(this).addClass('hover');
					$('.sublist:eq('+i+')').show();
				},
				function(){
					$(this).removeClass('hover');
					$('.sublist:eq('+i+')').hide();
				}
			);
		}
	);

	//排行,浏览记录的图片
	$('#ranklist li').hover(
		function(){
			$(this).addClass('current');
		},
		function(){
			$(this).removeClass('current');
		}
	);
});
</script>
</body>
</html>
