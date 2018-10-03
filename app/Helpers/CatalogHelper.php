<?php

/**
 * @param $cats
 * @param $parent_id
 * @param bool $only_parent
 * @return null|string
 */
function build_tree($cats, $parent_id, $only_parent = false)
{
    if (is_array($cats) && isset($cats[$parent_id])) {
        $tree = '<ul>';
        if ($only_parent == false) {
            foreach ($cats[$parent_id] as $cat) {
                $tree .= '<li>' . $cat['name'] . ' <a title="Добавить подкатегорию" href="' . url('admin/catalog/create/' . $cat['id']) .'"> <span class="fa fa-plus"></span> </a> <a title="Редактировать" href="' . url('admin/catalog/edit/'. $cat['id']) . '"> <span class="fa fa-pencil"></span> </a> <a title="Удалить" href="' . url('/admin/catalog/delete/' . $cat['id']).'"> <span class="fa fa-trash-o"></span> </a>';
                $tree .= build_tree($cats, $cat['id']);
                $tree .= '</li>';
            }
        } elseif (is_numeric($only_parent)) {
            $cat = $cats[$parent_id][$only_parent];
            $tree .= '<li>' . $cat['name'] . ' #' . $cat['id'];
            $tree .= build_tree($cats, $cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    } else return null;
    return $tree;
}

/**
 * @param $tmp
 * @param $cur_id
 * @return int
 */
function find_parent($tmp, $cur_id)
{
    if ($tmp[$cur_id][0]['parent_id'] != 0) {
        return find_parent($tmp, $tmp[$cur_id][0]['parent_id']);
    }
    return (int)$tmp[$cur_id][0]['id'];
}


