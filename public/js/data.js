function showMessage(message, isError = true){
    if(isError) toastr.error(message, 'Wystąpił błąd');
    else toastr.success(message, 'Sukces');
}

function addNode(name, parentType, parentId = null){
    if(parentType !== "currently-selected") parentId = null;
    fetchData('add-node', 'POST', {name:name, parent_id: parentId ? parentId : ''}).then(response => {
        if(response.status !== "ok") showMessage(response.message);
        else{
            const newNodeData = {
                text: name,
                id: response.data.id
            };
            $('#tree').jstree(true).create_node(parentId, newNodeData, 'last');
            expandNode(parentId);
            showMessage('Węzeł został pomyślnie dodany', false);
        }
    });
}

function moveNode(nodeId, parentId, order){
    console.log(order);
    fetchData('move-node', 'POST', {node_id: nodeId, parent_id: parentId, order: order}).then(response => {
        if(response.status !== "ok") showMessage(response.message);
        else expandNode(parentId);
    });
}

function removeNode(nodeId, removingType){
    fetchData('remove-node', 'POST', {node_id: nodeId !== null ? nodeId : '', removing_type: removingType}).then(response => {
        if(response.status !== "ok") showMessage(response.message);
        else{
            const childrens = getTree().get_node(nodeId).children_d;
            const parent = getTree().get_node(nodeId).parent;
            switch(removingType){
                case "recursive":
                    getTree().delete_node(nodeId);
                    break;
                default:
                    getTree().move_node(childrens, parent, "last");
                    getTree().delete_node(nodeId, false);
                    break;
            }

            updateSelectedNode();
            showMessage('Węzeł został usunięty', false);
        }
    });
}

function updateNodeName(nodeId, name){
    fetchData('update-name', 'POST', {node_id: nodeId, name: name}).then(response => {
        if(response.status !== "ok") showMessage(response.message);
        else{
            $("#tree").jstree('rename_node', nodeId, name);
            showMessage('Nazwa węzła została zmieniona', false);
        }
    });
}



function fetchData(url, method = 'GET', data = {}) {
    return new Promise((resolve, reject) => {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        const options = {
            method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': csrfToken
            }
        };

        if (method === 'POST') {
            const formData = new URLSearchParams();
            for (const key in data) {
                formData.append(key, data[key]);
            }
            options.body = formData;
        }

        fetch(url, options)
            .then(response => {
                return response.json();
            })
            .then(data => resolve(data))
            .catch(error => reject(error));
    });
}
