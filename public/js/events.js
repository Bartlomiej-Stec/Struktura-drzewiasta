$('#tree').on("select_node.jstree", function (e, data) {
    const selectedNode = data.selected[0];
    updateSelectedNode(data.instance.get_node(selectedNode).text);
});

$('#tree').on('move_node.jstree', function(e, data) {
    const nodeId = data.node.id;
    const parentId = data.parent !== '#' ? data.parent : '';
    const order = data.position+1;
    moveNode(nodeId, parentId, order)
});

$(document).ready(function(){
    fetchData('/get-tree').then(response => {
        buildTree(response.data);
    });
});

$('#createNode').on('click', function(){
    const name = document.querySelector('#newNodeName').value;
    const parentType = document.querySelector('#parent-select').value;

    if(name) addNode(name, parentType, getSelectedNode());
});

$('.delete').on('click', function(){
    const type = $(this).attr("data-type");
    removeNode(getSelectedNode(), type);
});

$('#changeName').on('click', function(){
    const name =  document.querySelector('#updateNodeName').value;
    updateNodeName(getSelectedNode(), name);
});
