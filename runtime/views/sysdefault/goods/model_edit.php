<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iwebshop/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo $this->getWebSkinPath()."images/admin/logo.png";?>" width="303" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="topMenu">
					<?php $menuData=menu::init($this->admin['role_id']);?>
					<?php foreach(menu::getTopMenu($menuData) as $key => $item){?>
					<li>
						<a hidefocus="true" href="<?php echo IUrl::creatUrl("".$item."");?>"><?php echo isset($key)?$key:"";?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>">修改密码</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = {$this->admin['admin_id']} and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu">
				<?php $leftMenu=menu::get($menuData,IWeb::$app->getController()->getId().'/'.IWeb::$app->getController()->getAction()->getId())?>
				<?php foreach(current($leftMenu) as $key => $item){?>
				<li>
					<span><?php echo isset($key)?$key:"";?></span>
					<ul name="leftMenu">
						<?php foreach($item as $leftKey => $leftValue){?>
						<li><a href="javascript:void(0);" onclick="<?php if(stripos($leftKey,'/') === 0){?>window.location.href='<?php echo IUrl::creatUrl("".$leftKey."");?>'<?php }else{?><?php echo isset($leftKey)?$leftKey:"";?><?php }?>"><?php echo isset($leftValue)?$leftValue:"";?></a></li>
						<?php }?>
					</ul>
				</li>
				<?php }?>
			</ul>
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<div class="headbar clearfix">
	<div class="position"><span>商品</span><span>></span><span>模型管理</span><span>></span><span>模型编辑</span></div>
</div>

<form name="ModelForm" action="<?php echo IUrl::creatUrl("/goods/model_update");?>" method="post">
	<div class="content_box">
		<div class="content form_content">
			<!--属性表格-->
			<table class="form_table">
				<colgroup>
					<col width="150px" />
					<col />
				</colgroup>

				<tr>
					<th>模型名称：</th>
					<td>
						<input class="normal" name="model_name" id="model_name" type="text" pattern="required" alt="模型名称不能为空！" value="<?php echo isset($name)?$name:"";?>"  /><label>* 模型名称（必填）</label>
						<input name="model_id" type="hidden" value="<?php echo isset($id)?$id:"";?>" />
					</td>
				</tr>
				<tr>
					<th>添加扩展属性：</th>
					<td><button class="btn" onclick="addAttr()" type="button"><span class="add">添加扩展属性</span></button></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width="90%" class='border_table'>
							<thead>
								<tr>
									<th>属性名</th>
									<th>操作样式</th>
									<th>选择项数据【每项数据之间用逗号','做分割】</th>
									<th>是否作为商品的筛选项</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody id="attr_list"></tbody>

							<!--属性列表-->
							<script type='text/html' id='attrListTemplate'>
							<%for(var item in templateData){%>
							<%include('attrTrTemplate',{'item':templateData[item]})%>
							<%}%>
							</script>

							<!--属性单行-->
							<script type='text/html' id='attrTrTemplate'>
							<tr class='td_c'>
								<td>
									<input name='attr[id][]' type='hidden' value="<%=item['id']%>" />
									<input name='attr[name][]' class='small' type='text' pattern='required' value="<%=item['name']%>" />
								</td>
								<td>
									<select class="middle" name='attr[show_type][]'>
										<option value='1' <%if(item['type']=='1'){%>selected<%}%>>单选框</option>
										<option value='2' <%if(item['type']=='2'){%>selected<%}%>>复选框</option>
										<option value='3' <%if(item['type']=='3'){%>selected<%}%>>下拉框</option>
										<option value='4' <%if(item['type']=='4'){%>selected<%}%>>输入框</option>
									</select>
								</td>
								<td>
									<input class='normal' name='attr[value][]' type='text' value="<%=item['value']%>" />
								</td>
								<td>
									<input type='checkbox' <%if(item['search']== '1'){%>checked<%}%> onclick="selectCheck(this)" />
									<input type='hidden' name='attr[is_search][]' value="<%=item['search']?item['search']:0%>" />
								</td>
								<td>
									<img class="operator" src="<?php echo $this->getWebSkinPath()."images/admin/icon_del.gif";?>" alt="删除" onclick="delAttr(this)" />
								</td>
							</tr>
							</script>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button class="submit" type="submit"><span>保 存</span></button></td>
				</tr>
			</table>
		</div>
	</div>
</form>

<script type='text/javascript'>
$(function(){
	//初始化属性
	<?php if(isset($model_attr)){?>
	var attrListHtml = template.render('attrListTemplate',{'templateData':<?php echo JSON::encode($model_attr);?>});
	$('#attr_list').html(attrListHtml);
	<?php }?>
});

//添加一个模型属性
function addAttr()
{
	var attrTrHtml = template.render('attrTrTemplate',{'item':[]});
	$('#attr_list').append(attrTrHtml);
}

//删除模型属性
function delAttr(curr_attr)
{
	$(curr_attr).parent().parent().remove();
}

//设置选择复选框的值
function selectCheck(_self)
{
	var checkValue = $(_self).siblings('[name="attr[is_search][]"]')[0];

	if($(_self).prop("checked"))
	{
		checkValue.value = 1;
	}
	else
	{
		checkValue.value = 0;
	}
}
</script>
		</div>
	</div>

	<script type='text/javascript'>
	//隔行换色
	$(".list_table tr:nth-child(even)").addClass('even');
	$(".list_table tr").hover(
		function () {
			$(this).addClass("sel");
		},
		function () {
			$(this).removeClass("sel");
		}
	);

	//按钮高亮
	var topItem  = "<?php echo key($leftMenu);?>";
	$("ul[name='topMenu']>li:contains('"+topItem+"')").addClass("selected");

	var leftItem = "<?php echo IUrl::getUri();?>";
	$("ul[name='leftMenu']>li a[href^='"+leftItem+"']").parent().addClass("selected");
	</script>
</body>
</html>
