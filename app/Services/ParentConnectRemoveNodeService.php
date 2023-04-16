<?php

namespace App\Services;
use App\Models\Tree;
use Illuminate\Support\Facades\DB;

class ParentConnectRemoveNodeService extends AbstractRemoveNodeService{
    private function getParentId(){
        $result = Tree::where('id', '=', $this->nodeId)->pluck('parent_id');
        if($result->isEmpty()) return null;
        return $result[0];
    }

    public function removeNode()
    {
        $parentId = $this->getParentId();
        $lastOrderPosition = $this->getLastPosition($parentId);
        Tree::where('parent_id', '=', $this->nodeId)
            ->update([
                'parent_id' => $parentId,
                'order' => DB::raw("`order` + $lastOrderPosition")
            ]);
        $this->deleteNode();
    }
}
