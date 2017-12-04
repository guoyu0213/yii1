<?php
class miao extends pluginBase{
    public static function name(){
        return '***秒杀活动***';
    }
    public static function description()
    {
        return '秒杀活动1';
    }
    public static function install()
    {
        $miaoM=new IModel('miao');
        $miaoUserM=new IModel('miaoUser');
        $miaoMDDLArr=array(
            'comment'=>'秒杀活动表',
            'column'=>array(
                'id'=>array(
                    'type'=>'init(11)',
                    'auto_increment'=>1,
                    'comment'=>'自增ID'
                ),
                'goods_id'=>array(
                    'type'=>'init(11)',
                    'comment'=>'商品ID',
                ),
                'price'=>array(
                    'type'=>'decimal',
                    'comment'=>'秒杀活动价格',
                ),
                'p_mun'=>array(
                    'type'=>'init(11)',
                    'comment'=>'库存',
                ),
                'p_time'=>array(
                    'type'=>'init(11)',
                    'comment'=>'秒杀开始和结束时间',
                ),
                'content'=>array(
                    'type'=>'varchar(50)',
                    'comment'=>'描述',
                ),
            ),
            "id"=>array(
                "primary"=>"id",
            ),
        );

    }

    public function reg(){
        plugin::reg("onSystemMenuCreate",function(){
            Menu::$menu['插件']['插件管理']['/plugins/miao']='增加秒杀';
        });
        plugin::reg("onBeforeCreateAction@plugins@miao",function (){
            self::controller()->miao=function(){
                $goodsM=new IModel();
                $goodsList=$goodsM->query("",'id,name');
                $this->redirect("miao",["goodsList=$goodsList"]);
            };
        });
    }
}
?>