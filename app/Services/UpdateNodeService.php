<?php

namespace App\Services;

use App\Models\Tree;

class UpdateNodeService{
    public static function renameNode($nodeId, $name){
         Tree::where('id', $nodeId)->update(['name' => $name]);
    }
}
