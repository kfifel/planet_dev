let indexArticle = 0
let current = 0
let articles = []
let titleValidation = false;
let contentValidation = false;
let authorValidation = false;
let categoryValidation = false;

function addArticleField(event){
    event.preventDefault()
    validateForm();
    if(titleValidation && contentValidation && authorValidation && categoryValidation){
        document.querySelectorAll("#progressbarArticles .hidden").forEach(e=> e.classList.remove("hidden"))
        if(current === indexArticle){
            articles.push(getFormData())
            resetForm()
            indexArticle++
            current++
            document.getElementById("countArticles").innerText = `${current+1}`
        }
        else
        {
            articles.splice(current, 1, getFormData())
            current = indexArticle
            indexArticle++
            current++
            resetForm()
            document.getElementById("countArticles").innerText = `${current+1}`
        }
    }
}

function validateContent() {
    let content = document.getElementById("article-content")
    let notify = document.getElementById("content-validation")
    let contentRegex = /^[A-Za-z0-9\s\.\?,!()\-\–'":]{50,60000}$/;

    if( contentRegex.test(content.value) ){
        notify.innerText = "No problem here";
        notify.classList.remove('text-red-800')
        notify.classList.add('text-green-800')
        contentValidation = true;
    }else{
        notify.innerText = "You have to insert at min 50 character and 60000 max white space and . ?,! is valid";
        notify.classList.add('text-red-800')
        notify.classList.remove('text-green-800')
        contentValidation = false;
    }
}

function validateTitle() {
    let title = document.getElementById("article-title")
    let notify = document.getElementById("title-validation")
    let titleRegex = /^[A-Za-z0-9\s]{10,100}$/;

    if( titleRegex.test(title.value) ){
        notify.innerText = "No problem here";
        notify.classList.remove('text-red-800')
        notify.classList.add('text-green-800')
        titleValidation = true
    }else{
        notify.innerHTML = "You have to insert at min 10 character <strong>only</strong> and 100 max";
        notify.classList.add('text-red-800')
        notify.classList.remove('text-green-800')
        titleValidation = false
    }
}


function validateForm() {
    validateTitle()
    validateContent()

    let authorNotify = document.getElementById("author-validation");
    let categoryNotify = document.getElementById("category-validation");

    if( document.getElementById('article-author').value === "" || !/^[0-9]+$/.test(document.getElementById('article-author').value)){
        authorNotify.innerText = "this element is required"
        authorNotify.classList.add('text-red-800')
        authorValidation = false
    }else{
        authorNotify.innerText = ""
        authorNotify.classList.remove('text-red-800')
        authorValidation = true
    }

    if( document.getElementById('article-category').value === "" || !/^[0-9]+$/.test(document.getElementById('article-category').value) ){
        categoryNotify.innerText = "this element is required"
        categoryNotify.classList.add('text-red-800')
        categoryValidation = false
    }else{
        categoryNotify.innerText = ""
        categoryNotify.classList.remove('text-red-800')
        categoryValidation = true
    }
}

function getFormData(){
    validateForm()
    return {
        title:      document.getElementById('article-title'  ).value,
        content:    document.getElementById('article-content').value,
        author:     parseInt(document.getElementById('article-author' ).value),
        category:   parseInt(document.getElementById('article-category' ).value)
    }
}

function resetForm() {
    document.getElementById('article-author' ).value = ""
    document.getElementById('article-title'  ).value = ""
    document.getElementById('article-content').value = ""
    document.getElementById('article-category').value = ""
}


function showNextArticle(){
        if(current === indexArticle){
            document.getElementById("next").setAttribute("disabled","disabled")
            document.getElementById("previous").removeAttribute("disabled");
        }
        else if( current < indexArticle && current >= 0 )
        {
            alert("in next")
            current++;
            document.getElementById("previous").removeAttribute("disabled");
            showArticle()
        }
        else
        {
            alert('no element selected')
        }

}

function showPreviousArticle(){

    if( current === 0) {
        alert("impossible")
        document.getElementById("previous").setAttribute("disabled", "disabled");
    }
    if( current <= indexArticle && current > 0 ){
        alert("in previous")
        current--;
        document.getElementById("next").removeAttribute("disabled");
        if( current === 0) {
            document.getElementById("previous").setAttribute("disabled", "disabled");
        }
        showArticle()
    } else {
        alert('no element selected')
    }

}

function showArticle(){
    document.getElementById("countArticles").innerText = `${current+1}`

    document.getElementById('article-author' ).value = articles[current].author
    document.getElementById('article-title'  ).value =  articles[current].title
    document.getElementById('article-content').value =  articles[current].content
    document.getElementById('article-category').value =  articles[current].category

}


async function saveArticle() {
    validateForm()

    if(titleValidation && contentValidation && authorValidation && categoryValidation && indexArticle === current){
        articles.push(getFormData());
        console.log(articles)
        const response = await postMapping("http://localhost:8080/src/includes/router.php?createArticles", articles)
        if(response.ok){
            const data = await response.text();
            if(data === 'true'){
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Article has been saved',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    setTimeout(()=>{
                            window.location.href = "http://localhost:8080/src/admin/article.php"
                        },
                        2000
                    )
                )
            }else{
                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong!',
                    timer: 1500
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                text: 'There was an error with the request!',
                timer: 1500
            })
        }

    }
}

function editArticle(id) {
}

function overviewArticle(id) {
}

function deleteArticle(id) {
    const notify = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-error ml-4',
            cancelButton: 'btn btn-success'
        },
        buttonsStyling: false
    })

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
            getMapping(`http://localhost:8080/src/includes/router.php?deleteArticles=1&id=${id}`)
                .then(res=> res.text())
                .then(data=>{
                    console.log(data)
                    if(data === "true")
                        notify.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    else
                        notify.fire(
                            'Error !',
                            'some error is occurred! article is not deleted !',
                            'error'
                        )
                })
        } else if (
            /* Read more about handling dismissals below */
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