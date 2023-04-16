<?php

namespace App\Services;

use App\Models\Tree;

class CreateNodeService extends NodeService {

    public function createNode($name, $parentId){
        $maxOrder = $this->getLastPosition($parentId);
        if(is_null($maxOrder)) $maxOrder = 0;
        $tree = Tree::create([
            'name' => $name,
            'parent_id' => $parentId,
            'order' => $maxOrder+1
        ]);

        return $tree->id;
    }
}
