<?php


namespace App\Constant;


class SysConstant
{
    const NO_GROUP_CHIEF = [59, 66, 18];  //  唐茜平小号、刘思敏小号、彭俊（组长）

    const TAG_TYPE = [
        1  => '考试类型',
        2  => '报考地区',
        12 => '考试经历',
        11 => '年龄段',
        3  => '基础情况',
        14 => '用户类型',
        6  => '购买意向强度',
        5  => '性别',
        4  => '已购课程',
        7  => '来源渠道',
        8  => '转化',
        9  => '电话情况',
        10 => '注册情况',
    ];

    //后台图标
    const NAV_ICON = [
        'layui-icon-group' => '群组',
        'layui-icon-app' => '应用',
        'layui-icon-cols' => '纵列',
        'layui-icon-home' => '主页',
        'layui-icon-console' => '控制台',
        'layui-icon-cart' => '购物车',
        'layui-icon-component' => '组件',
        'layui-icon-set-fill' => '设置-实心',
        'layui-icon-find-fill' => '发现-实心',
        'layui-icon-chart-screen' => '图标-报表',
        'layui-icon-release' => '发布-纸飞机',
    ];
}
