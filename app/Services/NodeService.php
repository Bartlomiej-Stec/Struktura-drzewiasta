<?php

namespace App\Services;

use App\Models\Tree;

class NodeService{

    protected function getLastPosition($parentId){
        return Tree::where('parent_id', '=', $parentId)->max('order');
    }
}
