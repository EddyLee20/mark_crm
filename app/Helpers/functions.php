<?php

function request_intersect($keys)
{
    return array_filter(request()->only(is_array($keys) ? $keys : func_get_args()));
}

function make_tree(array $list, $parentId = 0)
{
    $tree = [];
    if (empty($list)) {
        return $tree;
    }

    $newList = [];
    foreach ($list as $k => $v) {
        $newList[$v['id']] = $v;
    }

    foreach ($newList as $value) {
        if ($parentId == $value['parent_id']) {
            $tree[] = &$newList[$value['id']];
        } elseif (isset($newList[$value['parent_id']])) {
            $newList[$value['parent_id']]['children'][] = &$newList[$value['id']];
        }
    }

    return $tree;
}

function admin_enum_index_value($field, $index)
{
    $config = config("admin." . $field);

    return isset($config[$index]) ? $config[$index] : null;
}

function admin_enum_option_string($field, $default = null)
{
    $options = null;

    $items = config("admin." . $field);
    if (!$items) {
        return $options;
    }

    foreach ($items as $index => $value) {
        $checked = $index == $default ? 'selected' : '';
        $options .= sprintf('<option value="%s" %s > %s</option>', $index, $checked, $value);
    }

    return $options;
}

function admin_user_can($permissionName)
{
    return auth()->guard("admin")->user()->can($permissionName);
}

function type_li_string($field)
{
    $li = null;
    $items = config("admin." . $field);
    if (!$items) {
        return $li;
    }
    $path = explode('/', request()->path());
    $type = $path[1] ?? 'admin';
    foreach ($items as $index => $value) {
        $checked = $value['key'] == $type ? 'layui-this' : '';
        $li .= sprintf('<li class="layui-nav-item %s"><a href="%s">%s</a></li>', $checked, $value['url'], $value['name']);
    }
    return $li;
}

function type_option_string($field, $default = null)
{
    $options = null;
    $items = config("admin." . $field);
    if (!$items) {
        return $options;
    }
    foreach ($items as $index => $value) {
        $checked = $value['key'] == $default ? 'selected' : '';
        $options .= sprintf('<option value="%s" %s > %s</option>', $value['key'], $checked, $value['name']);
    }
    return $options;
}
