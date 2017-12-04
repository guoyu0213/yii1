<?php


class luck extends pluginBase
{
    public static function name()
    {
        return "***插件名称-幸运大转盘";
    }

    public static function descriotion()
    {
        return "实现幸运大转盘功能";
    }

    public function reg()
    {
        plugin::reg("onUcenterMenuCreate", function () {
            menuUcenter::$menu['幸运抽奖']['/ucenter/luckUrl'] = '幸运大转盘';
            menuUcenter::$menu['幸运抽奖']['/ucenter/luckList'] = '奖品列表';
        });
        plugin::reg("onBeforeCreateAction@ucenter@luckUrl", function () {
            self::controller()->luckUrl = function () {
                $this->redirect('luckUrl');
            };

        });
    }
}