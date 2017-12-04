<?php
class adput extends pluginBase{
	public static function name(){
		return "***插件名称-广告定点投放";
	}
	public static function description(){
		return self::name();
	}

	public static function install(){
		$adCityM = new IModel('ad_city');
		if (!$adCityM->exists()) {
			$adCityArr = array(
				'comment' => '广告于城市关联表',
				'column' => array(
					'id' => array(
						'type' => 'smallint(5)',
						'auto_increment' => 1,
						'comment' => '自增主键ID'
					),
					'ad_id' => array(
						'type' => 'int(11)',
						'comment' => '关联广告表主键ID'
					),
					'ad_p_id' => array(
						'type' => 'int(11)',
						'comment' => '关联广告表主键ID'
					),
					'city' => array(
						'type'=> 'char(20)',
						'comment' => '关联投放城市ID'
					)
				),
				'index' => array(
					'primary' => 'id'
				)
			);
			$adCityM->setData($adCityArr);
			if ($adCityM->createTable()) {
				return ture;
			}else{
				return false;
			}
		}
		return true;
	}

	public static function uninstall(){
		$adCityM = new IModel('ad_city');
		return $adCityM->dropTable();
	}

	public function reg(){

	}
}


