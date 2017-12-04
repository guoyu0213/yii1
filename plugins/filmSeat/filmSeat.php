<?php
//class filmSeat extends pluginBase{
//    public static function name(){
//        return '插件名称-电影票在线选择';
//    }
//    public static function description()
//    {
//        return self::name();
//    }
//    public static function install()
//    {
//        $filmM=new IModel();
//        $filmDDL=array(
//            'comment'=>'电影票详情表',
//            'column'=>array(
//              'film_id'=>array(
//                  'type'=>'smallint(5)',
//              ),
//                'description'=>array(
//                    'type'=>'char(32)',
//                    "comment"=>'电影描述',
//                ),
//                'other_info'=>array(
//                    'type'=>'decimal(6,2)',
//                    'comment'=>'其他信息',
//                ),
//            ),
//                'index'=>array(
//                    'primary'=>'film_id',
//                ),
//        );
//        $filmDescM->setData($filmDDL);
//        $filmDescM=new IModel('film_desc');
//        $filmDescDDL=array(
//
//        );
//    }
//}
//
//?>