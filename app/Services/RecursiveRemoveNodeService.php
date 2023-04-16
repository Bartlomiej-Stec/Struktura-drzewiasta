<?php

namespace App\Services;
use App\Models\Tree;

class RecursiveRemoveNodeService extends AbstractRemoveNodeService{
    public function removeNode()
    {
        $this->deleteNode();
    }
}
