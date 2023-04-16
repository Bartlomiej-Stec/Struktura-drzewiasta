<?php

namespace App\Services;

use App\Models\Tree;

class TreeService{
    private function formatTreeData($data, $parentId = null)
    {
        $result = [];
        $nodes = array_filter($data, function ($node) use ($parentId) {
            return $node['parent_id'] == $parentId;
        });

        foreach ($nodes as $node) {
            $formattedNode = [
                'text' => $node['name'],
                'id' => $node['id'],
                'children' => $this->formatTreeData($data, $node['id'])
            ];

            $result[] = $formattedNode;
        }

        return $result;
    }

    public function getTree(){
        $tree = Tree::select()->orderBy('order')->get()->toArray();
        return $this->formatTreeData($tree);
    }
}
