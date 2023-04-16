<?php

namespace App\Services;

use App\Models\Tree;

class MoveNodeService extends NodeService{
    private $nodeId;
    private $parentId;
    private $order;

    private function getNodeData(){
        return Tree::where('id', '=', $this->nodeId)->first();
    }

    private function moveOtherNodes(){
        $this->freePlace();
        $this->takePlace();
    }

    public function freePlace(){
        $nodeData = $this->getNodeData();
        Tree::where('parent_id', '=', $nodeData['parent_id'])->where('order', '>', $nodeData['order'])->decrement('order');
    }

    public function takePlace(){
        Tree::where('order', '>=', $this->order)->where('parent_id', '=', $this->parentId)->increment('order');
    }

    public function moveNode(){
        $this->moveOtherNodes();
        Tree::where('id', '=', $this->nodeId)->update(['parent_id' => $this->parentId, 'order' => $this->order]);
    }

    public function __construct($nodeId, $parentId, $order){
        $this->nodeId = $nodeId;
        $this->parentId = $parentId;
        $this->order = $order;
    }

}
