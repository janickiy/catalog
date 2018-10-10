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
                $tree .= '<li>' . $cat['name'] . ' <a title="Добавить подкатегорию" href="' . url('admin/catalog/create/' . $cat['id']) . '"> <span class="fa fa-plus"></span> </a> <a title="Редактировать" href="' . url('admin/catalog/edit/' . $cat['id']) . '"> <span class="fa fa-pencil"></span> </a> <a title="Удалить" href="' . url('/admin/catalog/delete/' . $cat['id']) . '"> <span class="fa fa-trash-o"></span> </a>';
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

/**
 * @param $option
 * @param $parent_id
 * @param int $lvl
 * @return mixed
 */
function ShowTree(&$option, $parent_id, &$lvl = 0)
{
    $lvl++;

    $catalogs = \App\models\Catalog::where('parent_id', $parent_id)->get();

    foreach ($catalogs as $catalog) {
        $indent = '';
        for ($i = 1; $i < $lvl; $i++) $indent .= '-';

        $option[$catalog->id] = $indent . " " . $catalog->name;
        ShowTree($option, $catalog->id, $lvl);
        $lvl--;
    }

    return $option;
}

/**
 * @param $topbar
 * @param $parent_id
 * @return array
 */
function topbarMenu(&$topbar, $parent_id)
{
    if (is_numeric($parent_id)) {
        $result = \App\models\Catalog::where('id', $parent_id);

        if ($result->count() > 0) {
            $catalog = $result->first();
            $topbar[] = [$catalog->id, $catalog->name];

            topbarMenu($topbar, $catalog->parent_id);
        }
    }

    sort($topbar);

    return $topbar;
}

/**
 * @param $id
 * @return array
 */
function ShowSubCat($id)
{
    $catalogs = \App\models\Catalog::selectRaw('catalog.id, catalog.name, COUNT(links.status) AS number_links')
        ->leftJoin('links', 'links.catalog_id', '=', 'catalog.id')
        ->groupBy('catalog.id')
        ->groupBy('catalog.name')
        ->orderBy('catalog.name')
        ->where('catalog.parent_id', $id)
        ->get();

    $sub_category_list = [];

    if ($catalogs) {
        foreach ($catalogs as $catalog) {
            $sub_category_list[] = '<a href="' . url('/' . $catalog->id) . '">' . $catalog->name . '</a> <span>(' . $catalog->number_links . ')</span>';
        }
    }

    return implode(', ', $sub_category_list);
}


