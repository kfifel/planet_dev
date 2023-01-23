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