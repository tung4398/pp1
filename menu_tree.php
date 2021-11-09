<?php

function createMenuTree(&$menuList, $parent_id) {
    $menuTree = array();
    foreach($menuList as $key => $menu) {
        if($menu['parent_id'] == $parent_id) {
            $children = createMenuTree($menuList, $menu['id']);
            if($children) {
                $menu['children'] = $children;
            }
            // var_dump($menu);
            $menuTree[] = $menu;
            unset($menuList[$key]);
        }
    }
    // var_dump($menuTree);
    return $menuTree;
}

function showMenu($menuTree, $level) {
    $level++;
    foreach($menuTree as $item) {
        if($level > 3) {
            echo "<h2 class='submenu__title text-primary'>------".$item['name']."</h2>";
        } else if ($level > 2) {
            echo "<h2 class='submenu__title text-danger'>---".$item['name']."</h2>";
        } else if ($level > 1) {
            echo "<h2 class='submenu__title text-warning'>".$item['name']."</h2>";
        }
        if(!empty($item['children'])) {
            showMenu($item['children'], $level);
        }
    }
}
?>