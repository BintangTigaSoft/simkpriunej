<?php

namespace App\Cells;

use App\Models\MenuModulModel;

class SidebarCell
{
    public function render()
    {
        $model = new MenuModulModel();
        
        $menuTree = $model->getTree();

        return view('components/layout/sidebar', ['menu' => $menuTree]);
    }
}
