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
			<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/iwebshop/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/iwebshop/index.php?controller=pic&action=file_manager_json";</script>
<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/my97date/wdatepicker.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jqueryFileUpload/jquery.ui.widget.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jqueryFileUpload/jquery.iframe-transport.js"></script><script type="text/javascript" charset="UTF-8" src="/iwebshop/runtime/_systemjs/jqueryFileUpload/jquery.fileupload.js"></script>

<div class="headbar clearfix">
	<div class="position"><span>商品</span><span>></span><span>商品管理</span><span>></span><span>商品编辑</span></div>
	<ul class="tab" name="menu1">
		<li id="li_1" class="selected"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('1')">商品信息</a></li>
		<li id="li_2"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('2')">描述</a></li>
		<li id="li_3"><a href="javascript:void(0)" hidefocus="true" onclick="select_tab('3')">营销选项</a></li>
	</ul>
</div>

<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/goods/goods_update");?>" name="goodsForm" method="post" novalidate="true" enctype="multipart/form-data">
			<input type="hidden" name="id" value="" />
			<input type='hidden' name="img" value="" />
			<input type='hidden' name="_imgList" value="" />
			<input type='hidden' name="callback" value="<?php echo IUrl::getRefRoute();?>" />

			<div id="table_box_1">
				<table class="form_table">
					<colgroup>
						<col width="150px" />
						<col />
					</colgroup>
					<tr>
						<th>商品名称：</th>
						<td>
							<input class="normal" name="name" type="text" value="" pattern="required" alt="商品名称不能为空" /><label>*</label>
						</td>
					</tr>
					<tr>
						<th>关键词：</th>
						<td>
							<input type='text' class='middle' name='search_words' value='' />
							<label>每个关键词最长为15个字符，必须以","(逗号)分隔符</label>
						</td>
					</tr>
					<tr>
						<th>所属商户：</th>
						<td>
							<select class="auto" name="seller_id">
								<option value="0">商城平台自营 </option>
								<?php $query = new IQuery("seller");$query->where = "is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?>-<?php echo isset($item['seller_name'])?$item['seller_name']:"";?></option>
								<?php }?>
							</select>
							<a href='<?php echo IUrl::creatUrl("/member/seller_edit");?>' class='orange'>请点击添加商户</a>
						</td>
					</tr>
					<tr>
						<th>所属分类：</th>
						<td>
							<div id="__categoryBox" style="margin-bottom:8px"></div>
							<button class="btn" type="button" name="_goodsCategoryButton"><span class="add">设置分类</span></button>
							<?php plugin::trigger('goodsCategoryWidget',array("type" => "checkbox","name" => "_goods_category[]","value" => isset($goods_category) ? $goods_category : ""))?>
							<a href='<?php echo IUrl::creatUrl("/goods/category_edit");?>' class='orange'>请点击添加分类</a>
						</td>
					</tr>
					<tr>
						<th>是否上架：</th>
						<td>
							<label class='attr'><input type="radio" name="is_del" value="0" checked> 是</label>
							<label class='attr'><input type="radio" name="is_del" value="2"> 否</label>
							<label>只有上架的商品才会在前台显示出来，客户是无法看到下架商品</label>
						</td>
					</tr>
					<tr>
						<th>是否共享：</th>
						<td>
							<label class='attr'><input type="radio" name="is_share" value="1"> 是</label>
							<label class='attr'><input type="radio" name="is_share" value="0" checked> 否</label>
							<label>共享商品，只有商城平台的商品可以被商家复制，分销</label>
						</td>
					</tr>
					<tr>
						<th>是否免运费：</th>
						<td>
							<label class='attr'><input type="radio" name="is_delivery_fee" value="1"> 是</label>
							<label class='attr'><input type="radio" name="is_delivery_fee" value="0" checked> 否</label>
							<label>商品是否免运费</label>
						</td>
					</tr>
					<tr>
						<th>附属数据：</th>
						<td>
							<div class="con">
								<table class="border_table">
									<thead>
										<tr>
											<th>购买成功增加积分</th><th>排序</th><th>计件单位显示</th><th>购买成功增加经验值</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input class="small" name="point" type="text" pattern="int" value="0"/></td>
											<td><input class="small" name="sort" type="text" pattern="int" value="99"/></td>
											<td><input class="small" name="unit" type="text" value="件"/></td>
											<td><input class="small" name="exp" type="text" pattern="int" value="0"/></td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>基本数据：</th>
						<td>
							<div class="con">
								<table class="border_table">
									<thead id="goodsBaseHead"></thead>

									<!--商品标题模板-->
									<script id="goodsHeadTemplate" type='text/html'>
									<tr>
										<th>商品货号</th>
										<%var isProduct = false;%>
										<%for(var item in templateData){%>
										<%isProduct = true;%>
										<th><a href="javascript:confirm('确定要删除此列规格？','delSpec(<%=templateData[item]['id']%>)');"><%=templateData[item]['name']%>【删】</a></th>
										<%}%>
										<th>库存</th>
										<th>市场价格</th>
										<th>销售价格</th>
										<th>成本价格</th>
										<th>重量(克)</th>
										<%if(isProduct == true){%>
										<th>操作</th>
										<%}%>
									</tr>
									</script>

									<tbody id="goodsBaseBody"></tbody>

									<!--商品内容模板-->
									<script id="goodsRowTemplate" type="text/html">
									<%var i=0;%>
									<%for(var item in templateData){%>
									<%item = templateData[item]%>
									<tr class='td_c'>
										<td><input class="small" name="_goods_no[<%=i%>]" pattern="required" type="text" value="<%=item['goods_no'] ? item['goods_no'] : item['products_no']%>" /></td>
										<%var isProduct = false;%>
										<%var specArrayList = typeof item['spec_array'] == 'string' && item['spec_array'] ? JSON().parse(item['spec_array']) : item['spec_array'];%>
										<%for(var result in specArrayList){%>
										<%result = specArrayList[result]%>
										<input type='hidden' name="_spec_array[<%=i%>][]" value='<%=JSON().stringify(result)%>' />
										<%isProduct = true;%>
										<td>
											<%if(result['type'] == 1){%>
												<%=result['value']%>
											<%}else{%>
												<img class="img_border" width="30px" height="30px" src="<%=webroot(result['value'])%>">
											<%}%>
										</td>
										<%}%>
										<td><input class="tiny" name="_store_nums[<%=i%>]" type="text" pattern="int" value="<%=item['store_nums']?item['store_nums']:100%>" /></td>
										<td><input class="tiny" name="_market_price[<%=i%>]" type="text" pattern="float" value="<%=item['market_price']%>" /></td>
										<td>
											<input type='hidden' name="_groupPrice[<%=i%>]" value="<%=item['groupPrice']%>" />
											<input class="tiny" name="_sell_price[<%=i%>]" type="text" pattern="float" value="<%=item['sell_price']%>" />
											<button class="btn" type="button" onclick="memberPrice(this);"><span class="add <%if(item['groupPrice']){%>orange<%}%>">会员组价格</span></button>
										</td>
										<td><input class="tiny" name="_cost_price[<%=i%>]" type="text" pattern="float" empty value="<%=item['cost_price']%>" /></td>
										<td><input class="tiny" name="_weight[<%=i%>]" type="text" pattern="float" empty value="<%=item['weight']%>" /></td>
										<%if(isProduct == true){%>
										<td><a href="javascript:void(0)" onclick="delProduct(this);"><img class="operator" src="<?php echo $this->getWebSkinPath()."images/admin/icon_del.gif";?>" alt="删除" /></a></td>
										<%}%>
									</tr>
									<%i++;%>
									<%}%>
									</script>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>商品模型：</th>
						<td>
							<select class="auto" name="model_id" onchange="create_attr(this.value)">
								<option value="0">通用类型 </option>
								<?php $query = new IQuery("model");$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<label>可以加入商品扩展属性，比如：型号，年代，款式...</label>
						</td>
					</tr>
					<tr>
						<th>规格：</th>
						<td>
							<select class='auto' onchange='selSpecVal(this);' id='specNameSel'>
								<option value=''>选规格名称</option>
								<?php $query = new IQuery("spec");$query->where = "seller_id = 0 and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
								<option value='<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<select class='auto' onchange='selSpec(this);' id='specValSel'><option value='0'>选规格数据</option></select>
							<button class="btn" onclick="addNewSpec(0);" type="button"><span class="add">新建规格</span></button>
							<label>可从现有规格中选择或新建规格生成货品。比如：尺码，颜色，类型...</label>
						</td>
					</tr>
					<tr id="properties" style="display:none">
						<th>扩展属性：</th>
						<td>
							<table class="border_table1" id="propert_table">
							<script type='text/html' id='propertiesTemplate'>
							<%for(var item in templateData){%>
							<%item = templateData[item]%>
							<%var valueItems = item['value'].split(',');%>
							<tr>
								<th><%=item["name"]%></th>
								<td>
									<%if(item['type'] == 1){%>
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
											<label class="attr"><input type="radio" name="attr_id_<%=item['id']%>" value="<%=tempVal%>" /><%=tempVal%></label>
										<%}%>
									<%}else if(item['type'] == 2){%>
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
											<label class="attr"><input type="checkbox" name="attr_id_<%=item['id']%>[]" value="<%=tempVal%>"/><%=tempVal%></label>
										<%}%>
									<%}else if(item['type'] == 3){%>
										<select class="auto" name="attr_id_<%=item['id']%>">
										<%for(var tempVal in valueItems){%>
										<%tempVal = valueItems[tempVal]%>
										<option value="<%=tempVal%>"><%=tempVal%></option>
										<%}%>
										</select>
									<%}else if(item['type'] == 4){%>
										<input type="text" name="attr_id_<%=item['id']%>" value="<%=item['value']%>" class="normal" />
									<%}%>
								</td>
							</tr>
							<%}%>
							</script>
							</table>
						</td>
					</tr>
					<tr>
						<th>商品推荐类型：</th>
						<td>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="1" />最新商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="2" />特价商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="3" />热卖商品</label>
							<label class="attr"><input name="_goods_commend[]" type="checkbox" value="4" />推荐商品</label>
						</td>
					</tr>
					<tr>
						<th>商品品牌：</th>
						<td>
							<select class="auto" name="brand_id">
								<option value="0">请选择</option>
								<?php $query = new IQuery("brand");$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>产品相册：</th>
						<td>
							<input id="fileUpload" type="file" style="width:65px;" accept="image/png,image/gif,image/jpeg" name="_goodsFile" multiple="multiple" data-url="<?php echo IUrl::creatUrl("/goods/goods_img_upload");?>" />
							<label id="uploadPercent">可以上传多张图片，分辨率3000px以下，大小不得超过<?php echo IUpload::getMaxSize();?></label>
						</td>
					</tr>
					<tr>
					    <th>产品视频：</th>
					    <td>
					        <div>
					            <input type="file" name="video">
					        </div>
					        <label>可以上传视频，大小不得超过500M</label>
					    </td>
					</tr>
					<tr>
						<td></td>
						<td id="thumbnails"></td>

						<!--图片模板-->
						<script type='text/html' id='picTemplate'>
						<span class='pic'>
							<img name="picThumb" onclick="defaultImage(this);" style="margin:5px; opacity:1;width:100px;height:100px" src="<%=webroot(picRoot)%>" alt="<%=picRoot%>" />
							<p>
								<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').insertBefore($(this).parents('.pic').prev());"><img src="<?php echo $this->getWebSkinPath()."images/admin/arrow_left.png";?>" title="左移动" alt="左移动" /></a>
								<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').remove();"><img src="<?php echo $this->getWebSkinPath()."images/admin/sign_cacel.png";?>" title="删除" alt="删除" /></a>
								<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').insertAfter($(this).parents('.pic').next());"><img src="<?php echo $this->getWebSkinPath()."images/admin/arrow_right.png";?>" title="右移动" alt="右移动" /></a>
							</p>
						</span>
						</script>
					</tr>
				</table>
			</div>

			<div id="table_box_2" cellpadding="0" cellspacing="0" style="display:none">
				<table class="form_table">
					<colgroup>
						<col width="150px" />
						<col />
					</colgroup>
					<tr>
						<th>产品描述：</th>
						<td><textarea id="content" name="content" style="width:700px;height:400px;"></textarea></td>
					</tr>
				</table>
			</div>

			<div id="table_box_3" cellpadding="0" cellspacing="0" style="display:none">
				<table class="form_table">
					<col width="150px" />
					<col />
					<tr>
						<th>SEO关键词：</th><td><input class="normal" name="keywords" type="text" value="" /></td>
					</tr>
					<tr>
						<th>SEO描述：</th><td><textarea name="description"></textarea></td>
					</tr>
				</table>
			</div>

			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<td></td>
					<td><button class="submit" type="submit" onclick="return checkForm()"><span>发布商品</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script language="javascript">
//创建表单实例
var formObj = new Form('goodsForm');

//默认货号
var defaultProductNo = '<?php echo goods_class::createGoodsNo();?>';

$(function()
{
	//商品图片的回填
	<?php if(isset($goods_photo)){?>
	var goodsPhoto = <?php echo JSON::encode($goods_photo);?>;
	for(var item in goodsPhoto)
	{
		var picHtml = template.render('picTemplate',{'picRoot':goodsPhoto[item].img});
		$('#thumbnails').append(picHtml);
	}
	<?php }?>

	//商品默认图片
	<?php if(isset($form['img']) && $form['img']){?>
	$('#thumbnails img[name="picThumb"][alt="<?php echo $form['img'];?>"]').addClass('current');
	<?php }?>

	initProductTable();

	//存在商品信息
	<?php if(isset($form)){?>
	var goods = <?php echo JSON::encode($form);?>;

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':[goods]});
	$('#goodsBaseBody').html(goodsRowHtml);

	formObj.init(goods);

	//模型选择
	$('[name="model_id"]').change();
	<?php }else{?>
	$('[name="_goods_no[0]"]').val(defaultProductNo);
	<?php }?>

	//存在货品信息,进行数据填充
	<?php if(isset($product)){?>
	var spec_array = <?php echo $product[0]['spec_array'];?>;
	var product    = <?php echo JSON::encode($product);?>;

	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':spec_array});
	$('#goodsBaseHead').html(goodsHeadHtml);

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':product});
	$('#goodsBaseBody').html(goodsRowHtml);
	<?php }?>

	//商品促销回填
	<?php if(isset($goods_commend)){?>
	formObj.setValue('_goods_commend[]',"<?php echo join(';',$goods_commend);?>");
	<?php }?>

	//编辑器载入
	KindEditorObj = KindEditor.create('#content',{"filterMode":false});
});

//删除货品
function delProduct(_self)
{
	$(_self).parent().parent().remove();
	if($('#goodsBaseBody tr').length == 0)
	{
		initProductTable();
	}
}

//提交表单前的检查
function checkForm()
{
	//整理商品图片
	var goodsPhoto = [];
	$('#thumbnails img[name="picThumb"]').each(function(){
		goodsPhoto.push(this.alt);
	});
	if(goodsPhoto.length > 0)
	{
		$('input[name="_imgList"]').val(goodsPhoto.join(','));
		$('input[name="img"]').val($('#thumbnails img[name="picThumb"][class="current"]').attr('alt'));
	}
	return true;
}

//tab标签切换
function select_tab(curr_tab)
{
	$("form[name='goodsForm'] > div").hide();
	$("#table_box_"+curr_tab).show();
	$("ul[name=menu1] > li").removeClass('selected');
	$('#li_'+curr_tab).addClass('selected');
}

//根据模型动态生成扩展属性
function create_attr(model_id)
{
	$.getJSON("<?php echo IUrl::creatUrl("/block/attribute_init");?>",{'model_id':model_id,'random':Math.random()}, function(json)
	{
		if(json && json.length > 0)
		{
			var templateHtml = template.render('propertiesTemplate',{'templateData':json});
			$('#propert_table').html(templateHtml);
			$('#properties').show();

			//表单回填设置项
			<?php if(isset($goods_attr)){?>
			<?php $attrArray = array();?>
			<?php foreach($goods_attr as $key => $item){?>
			<?php $valArray = explode(',',$item);?>
			<?php $attrArray[] = '"attr_id_'.$key.'[]":"'.join(";",IFilter::act($valArray)).'"'?>
			<?php $attrArray[] = '"attr_id_'.$key.'":"'.join(";",IFilter::act($valArray)).'"'?>
			<?php }?>
			formObj.init({<?php echo join(',',$attrArray);?>});
			<?php }?>
		}
		else
		{
			$('#properties').hide();
		}
	});
}

//添加新规格
function addNewSpec(seller_id)
{
	var url = creatUrl("goods/spec_edit/seller_id/@seller_id@");
	url     = url.replace("@seller_id@",seller_id);
	art.dialog.open(url,{
		id:'addSpecWin',
	    title:'规格设置',
	    okVal:'确定',
	    ok:function(iframeWin, topWin){
	    	var formObject = iframeWin.document.forms['specForm'];
	    	if(formObject.onsubmit() == false)
	    	{
	    		return false;
	    	}
			$.getJSON(formObject.action,$(formObject).serialize(),function(json){
				if(json.flag == 'success' && json.data)
				{
					var insertHtml = '<option value="'+json.data.id+'">'+json.data.name+'</option>';
					$('#specNameSel').append(insertHtml);
					$('#specNameSel').find('option:last').attr("selected",true);
					$('#specNameSel').trigger('change');
					return true;
				}
				else
				{
					alert(json.message);
					return false;
				}
			});
	    }
	});
}
</script>
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."public/javascript/goods_edit.js";?>"></script>
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
