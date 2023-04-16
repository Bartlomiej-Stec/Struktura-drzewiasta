function getTree(){
    return $('#tree').jstree(true);
}

function getSelectedNode(){
    const nodes = getTree().get_selected();
    if(nodes.length === 0) return null;
    else return nodes[0];
}

function buildTree(data = []){
    return $("#tree").jstree({
        "core" : {
            "themes" : {
                "responsive": false
            },
            // so that create works
            "check_callback" : true,
            'data': data
        },
        "types" : {
            "default" : {
                "icon" : "ki-solid ki-folder text-success"
            },
            "file" : {
                "icon" : "ki-solid ki-file  text-success"
            }
        },
        "state" : { "key" : "demo2" },
        "plugins" : [ "dnd", "state", "types" ]
    });
}

function expandNode(nodeId){
    $('#tree').jstree('open_node', nodeId);
}

function updateSelectedNode(name = ""){
    document.querySelector('#selected-node').innerText = name;
}
