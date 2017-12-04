<?php
/**
 * @brief 升级更新控制器
 */
class Update extends IController
{
	/**
	 * @brief iwebshop16060600 版本升级更新
	 */
	public function index()
	{
		set_time_limit(0);

		$sql = array(
			"ALTER TABLE `{pre}refundment_doc` ADD  `trade_no` varchar(255) NOT NULL default '' COMMENT '支付平台退款流水号';",
			"ALTER TABLE `{pre}order` ADD `prorule_ids` varchar(255) NOT NULL default '' COMMENT '促销活动规格ID串，逗号分隔';",
			"UPDATE `{pre}right` SET `right`= 'market@sale_edit,market@sale_edit_act,market@sale_list'  WHERE name = '[营销]特价添加修改';",
		);
		foreach($sql as $key => $val)
		{
			IDBFactory::getDB()->query( $this->_c($val) );
		}

		die("升级成功!! V4.8版本");
	}

	public function _c($sql)
	{
		return str_replace('{pre}',IWeb::$app->config['DB']['tablePre'],$sql);
	}

	//查询规格标准
	public function searchSpec($specVal,$specValueArray)
	{
		foreach($specValueArray as $tip => $item)
		{
			if($item == $specVal && !is_numeric($tip))
			{
				return $tip;
			}
		}
		return "";
	}
}