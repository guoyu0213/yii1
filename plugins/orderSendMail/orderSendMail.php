<?php
//class orederSendmail extends pluginBase{
//    public static function name(){
//        return '下单之后发送通知邮件';
//    }
//    public static function description()
//    {
//        return self::name();
//    }
//    public function reg(){
//        plugin::reg('onFinishOrder',funciton($arr){
//            //入队
//            if (intval($arr['order_id'])>0) {
//                $redis = new Redis();
//                $redis->connect('127.0.0.1', '6379');
//                $redis->lpush('iweb_order_list', $arr['order_id']);
//            }
//}
//        plugin::reg('onBeforeCreateAction@site@orderSendMail',function () {
//            $redis = new Redis();
//            $redis->connect('127.0.0.1', '6379');
//            while (1) {
//                if ($order_id = $redis->lpop('iweb_order_list')) {
//                    $sql = '
//                   select goods.name,order_goods,real_price
//                   from
//                   iwebshop_order_goods AS order_goods
//                   JOIN
//                   iwebshop_goods As goods
//                   ON
//                   order_goods.goods_id=goods_id
//                   where order_goods.order_id=' . $order_id . '
//                   ';
//                    $result = IDBFactory::getDB()->query($sql);
//
//                }
//                sleep(1);
//            }
//        });
//    }
//}
//?>