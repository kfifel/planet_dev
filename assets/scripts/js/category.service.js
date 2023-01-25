let categories = [];

function deleteCategory(id){
    notify.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            postMapping("http://localhost:8080/src/controller/categoryController.php", {delete_category: id})
                .then(res=>res.text())
                .then(data=>{
                    console.log(data)
                    if(data === "true")
                        notify.fire(
                            'Deleted',
                            'Your category has been deleted with successful)',
                            'success'
                        )
                    else
                        notify.fire(
                            'Cancelled',
                            'Some error is occurred!',
                            'error'
                        )

                })
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            notify.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })

}

function setEnvironmentEdit(id, name) {
    document.getElementById('category-name').value = name;
    document.getElementById('category-id').value = id;

    document.getElementById('title-model').innerText = "Updating category";
    document.getElementById('submit-category').setAttribute("name", "update-category");

}

function setEnvironmentAdd(){
    document.getElementById('category-name').value = '';
    document.getElementById('category-id').value = '';

    document.getElementById('title-model').innerText = "adding new category";
    document.getElementById('submit-category').setAttribute("name", "save-category");
}

function searchCategory() {
    let search = document.getElementById('search').value ;
    if(search !== "")
        postMapping("http://localhost:8080/src/controller/categoryController.php", {search_categories:search})
            .then(res=> res.json())
            .then(data=>{
                if(data === "false"){
                    notify.fire(
                        'Warning',
                        'the type of input inserted should be characters or numbers!',
                        'warning'
                    )
                }
                else if(data === "error"){
                    notify.fire(
                        'Error',
                        'Some error is occurred!',
                        'error'
                    )
                }
                else
                {
                    console.log( data )
                    setCategories( data );
                    insertCategoriesToHTML();
                    console.log(categories)
                }
            })
    else
    {
            getMapping('http://localhost:8080/src/controller/categoryController.php?getAllCategories')
                .then(res=>res.json())
                .then(data=>{
                    console.log(data)
                    setCategories(data);
                    insertCategoriesToHTML();
                })
    }
}

function setCategories(data){
    categories=data;
}

function insertCategoriesToHTML() {

    let content = '';
    categories.forEach((category) =>
        {
            content += `
         <tr>
                            <td> ${category.name} </td>
                            <td>

                                <div class="flex gap-8">
                                    <button
                                            class="bg-transparent text-green-600 bg-white"
                                            data-modal-target="authentication-modal"
                                            data-modal-toggle="authentication-modal"
                                            onclick="setEnvironmentEdit( ${ category.id } , '${ category.name }' )"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button class="bg-transparent text-red-700 bg-white" onclick="deleteCategory( ${category.id} )">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <button class="bg-transparent text-blue-700 bg-white">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
        `;
        }
    )


    document.getElementById('body-categories').innerHTML = content;
}