<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateNodeRequest;
use App\Http\Requests\MoveNodeRequest;
use App\Http\Requests\RemoveNodeRequest;
use App\Http\Requests\UpdateNodeNameRequest;
use App\Services\CreateNodeService;
use App\Services\MoveNodeService;
use App\Services\ParentConnectRemoveNodeService;
use App\Services\RecursiveRemoveNodeService;
use App\Services\TreeService;
use App\Services\UpdateNodeService;
use Illuminate\Support\Facades\DB;
use App\Models\Tree;

use Illuminate\Http\Request;

class TreeController extends Controller
{
    private function result($data = []){
        $result['status'] = 'ok';
        $result['data'] = $data;
        return response()->json($result, 200);
    }

    public function getTree(){
        $treeService = new TreeService();
        return $this->result($treeService->getTree());
    }

    public function addNode(CreateNodeRequest $request)
    {
        $createNodeService = new CreateNodeService();
        $nodeId = $createNodeService->createNode($request->input('name'), $request->input('parent_id'));

        return $this->result(['id' => $nodeId]);
    }

    public function removeNode(RemoveNodeRequest $request){
        $removeNodeService = match ($request->input('removing_type')) {
            "recursive" => new RecursiveRemoveNodeService($request->input('node_id')),
            default => new ParentConnectRemoveNodeService($request->input('node_id'))
        };

        $removeNodeService->removeNode();
        return $this->result();
    }

    public function moveNode(MoveNodeRequest $request){
        $moveNodeService = new MoveNodeService($request->input('node_id'), $request->input('parent_id'), $request->input('order'));
        $moveNodeService->moveNode();
        return $this->result();
    }

    public function updateNodeName(UpdateNodeNameRequest $request){
        UpdateNodeService::renameNode($request->input('node_id'), $request->input('name'));
        return $this->result();
    }


}
