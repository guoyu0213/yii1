<?php
class seckill extends pluginBase
{
    public static function name()
    {
        return "插件名称-秒杀活动";
    }
    public static function description()
    {
        return self::name();
    }
    public static function install()
    {
        $seckillM=new IModel("seckill");
        $seckillUserM=new IModel("seckill_user");
        if(!$seckillM->exists()&&!$seckillUserM->exists())
        {
            $seckillMDDLArr=array
            (
                "comment"=>'秒杀活动表',
                "column"=>array(
                    "id"=>array(
                        "type"=>"int(11)",
                        "auto_increment"=>1,
                        "comment"=>"自增ID",
                    ),
                    "goods_id"=>array(
                        "type"=>"int(11)",
                        "comment"=>"商品ID",
                    ),
                    "begin_time"=>array(
                        "type"=>"int(11)",
                        "comment"=>"活动开始时间",
                    ),
                    "price"=>array(
                        "type"=>"decimal",
                        "comment"=>"秒杀活动商品价格"
                    ),
                    "total_num"=>array(
                        "type"=>"int(11)",
                        "comment"=>"参与秒杀的商品总数",
                    ),
                    "killed_num"=>array(
                        "type"=>"int(11)",
                        "comment"=>"被秒杀商品数量"
                    ),
                ),
                "index"=>array(
                    "primary"=>"id",
                ),
            );

            //创建订单表
            $seckillUserDLLA=array
            (
                "comment"=>"秒杀成功用户表",
                "column"=>array(
                    "seckill_id"=>array(
                        "type"=>"int(11)",
                        "comment"=>"秒杀活动",
                    ),
                    "user_id"=>array(
                        "type"=>"int(11)",
                        "comment"=>"秒杀成功用户",
                    ),
                    "ctime"=>array(
                        "type"=>"int(11)",
                        "comment"=>"秒杀时间"
                    ),
                ),
                "index"=>array(
                    "primary"=>"seckill_id,user_id",
                ),
            );
            $seckillM->setData($seckillMDDLArr);
            //创建订单表
            $seckillUserM->setData($seckillUserDLLA);
            return $seckillUserM->createTable()&&$seckillM->createTable();
        }
        return true;
    }
    public static function uninstall()
    {
        $seckillM=new IModel("seckill");
        $seckillUserM=new IModel("seckill_user");
        return $seckillM->dropTable()&&$seckillUserM->dropTable();
    }
    public function reg()
    {
        plugin::reg("onSystemMenuCreate",function(){
            Menu::$menu['插件']["插件管理"]['/plugins/seckill']="增加秒杀";
        });
        plugin::reg("onBeforeCreateAction@plugins@seckill",function(){
            self::controller()->seckill=function()
            {
                $goodsM=new IModel("goods");
                $goodsList=$goodsM->query("","id,name");
                $this->redirect("seckill",['goodsList'=>$goodsList]);
            };
        });
        plugin::reg("onBeforeCreateAction@plugins@seckill_add",$this,"seckillAdd");
        plugin::reg("onFinishAction@site@index",$this,"seckillSiteShow");
        plugin::reg("onBeforeCreateAction@site@seckill",$this,"siteSeckill");
    }
    public function siteSeckill()
    {
        self::controller()->seckill=function()
        {
            $userID=self::controller()->user['user_id'];
            if(!$userID)
            {
                echo '<script>alert("请先登录");location.href="/simple/login"</script>';
                exit;
            }
            $seckillID=IFilter::act(IReq::get("id"),"int");
            $seckillM=new IModel("seckill");
            $where="(begin_time+10)>".time();
            $filed='id,begin_time,total_num,killed_num';
            $order="begin_time asc";
            $limit="1";
            $seckillInfo=$seckillM->query($where,$filed,$order,$limit);
            $seckillInfo=$seckillInfo[0];
            if(!$seckillID||$seckillID!=$seckillInfo['id'])
            {
                echo '<script>alert("亲，不要做这样的事情");location.href="/site/index"</script>';
                exit;
            }
            if($seckillInfo['killed_num']>=$seckillInfo['total_num'])
            {
                echo '<script>alert("亲，库存不足");location.href="/site/index"</script>';
                exit;
            }
            if($seckillInfo['begin_time']-time()>10)
            {
                echo '<script>alert("亲，时间未到");location.href="/site/index"</script>';
                exit;
            }
            $seckillUserM=new IModel("seckill_user");
            if($seckillUserM->query("seckill_id=$seckillID and user_id=$userID"))
            {
                echo '<script>alert("恭喜你秒杀成功");location.href="/site/index"</script>';
                exit;
            }
            $where="id=".$seckillID;
            $seckillUArr=array
            (
                'killed_num'=>'killed_num+1',
            );
            $seckillM->setData($seckillUArr);
            if($seckillM->update($where,['killed_num']))
            {
                $this->addSeckillUser($seckillUserM,$seckillID,$userID);
                echo '<script>alert("恭喜你秒杀成功");location.href="/site/index"</script>';
                exit;
            }
            echo '<script>alert("很遗憾，你来晚啦");location.href="/site/index"</script>';
            exit;
        };
    }
    public function addSeckillUser($seckillUserM,$seckillID,$userID)
    {
        $seckillUserIArr=array
        (
            "seckill_id"=>$seckillID,
            "user_id"=>$userID,
            "ctime"=>time(),
        );
        $seckillUserM->setData($seckillUserIArr);
        $seckillUserM->add();
    }
    public function seckillAdd()
    {
        $seckillM=new IModel("seckill");
        $seckillADDA=array(
            "goods_id"=>IFilter::act(IReq::get("goods_id","post"),"int"),
            "begin_time"=>strtotime(IReq::get("begin_time","post")),
            "price"=>IFilter::act(IReq::get("price","post"),"float"),
            "total_num"=>IFilter::act(IReq::get("total_num","post"),"int"),
            "killed_num"=>0,
        );
        $seckillM->setData($seckillADDA);
        if($seckillM->add())
        {
            echo '<script>alert("秒杀活动添加成功");location.href="/plugins/seckill"</script>';
            exit;
        }
    }
    //展示
    public function seckillSiteShow()
    {
        //查询最近一条秒杀商品
        $seckillM=new IModel("seckill");
        if($seckillM->exists())
        {
            $where = '(begin_time+10)>' . time();
            $field = "id,goods_id,begin_time,price";
            $order = "begin_time asc";
            $limit = '1';
            $seckillInfo = $seckillM->query($where, $field, $order, $limit);
            $seckillInfo=$seckillInfo[0];
            if($seckillInfo)
            {
                //查询商品的图片
                $goodM = new IModel("goods");
                $goodsInfo = $goodM->query("id=" . $seckillInfo['goods_id'], "img");
                $seckillInfo['goods_img'] = isset($goodsInfo[0]) ? $goodsInfo[0]['img'] : "";
                if (isset($seckillInfo['goods_img']))
                {
                    //extract($seckillInfo);
                    $begin_time=date("Y-m-d H:i:s",$seckillInfo['begin_time']);
                    //输入一个js代码，往首页右侧添加一个DIV，里面是秒杀活动的详情
echo <<<EOT
<script>
$(function(){
$(".group_on").after('<div class="group_on box m_10"><div class="title"><h2>倒计时</h2><a class="timespan" href="#"></a></div><div class="cont"><ul class="ranklist"><li class="current"><a href="/index.php?controller=site&amp;action=groupon&amp;id={$seckillInfo['goods_id']}"><img width="60px" height="60px" src="{$seckillInfo['goods_img']}"></a><a href="/index.php?controller=site&action=seckill&id={$seckillInfo['id']}">点击秒杀</a><p class="light_gray">团购价：<em>￥{$seckillInfo['price']}</em></p></li></ul></div></div>');
var starttime = new Date("$begin_time");
setInterval(function () {
var nowtime = new Date();
var time = starttime - nowtime;
var day = parseInt(time / 1000 / 60 / 60 / 24);
var hour = parseInt(time / 1000 / 60 / 60 % 24);
var minute = parseInt(time / 1000 / 60 % 60);
var seconds = parseInt(time / 1000 % 60);
$('.timespan').html(day + "天" + hour + "小时" + minute + "分钟" + seconds + "秒");
}, 1000);
});
</script>
EOT;
                }
            }
        }
    }
}
?>