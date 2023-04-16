<?php
namespace App\Services;

use App\Models\Tree;

abstract class AbstractRemoveNodeService extends NodeService {
    protected $nodeId;

    public function __construct($nodeId){
        $this->nodeId = $nodeId;
    }

    protected function deleteNode(){
        $moveNodeService = new MoveNodeService($this->nodeId, null, null);
        $moveNodeService->freePlace();
        Tree::where('id', '=', $this->nodeId)->delete();

    }

    abstract public function removeNode();
}
