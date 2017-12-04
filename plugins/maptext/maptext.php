<?php
class maptext extends pluginBase{
	public static function name(){
		return "***插件名称-地图";
	}
	public static function description(){
		return '实现地图功能';
	}

	public function reg(){
		plugin::reg("onFinishView@simple@seller",function(){
			$this->show();
		});
	}

	public function show(){
		$ak = "ImNte6ZvTr63qUL5FoGYY38jOLtAAaIx";
		echo <<< OEF
			<script src="http://api.map.baidu.com/api?v=2.0&ak={$ak}"></script>
			<script>
				var map = new BMap.Map("map_iamzz");
				map.centerAndZoom("北京", 11);
				map.addControl(new BMap.MapTypeControl()); 
				map.setCurrentCity("北京");  
				map.enableScrollWheelZoom(true); 
				map.addEventListener("click",function(e){
					window.document.getElementById('map_in').value=e.point.lng + "," + e.point.lat;
				});
			</script>
OEF;
	}
}