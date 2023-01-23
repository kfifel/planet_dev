
let indexArticle = 0;
let current = 0;
let articles = [];
let AllArticles = [];
let titleValidation = false;
let contentValidation = false;
let authorValidation = false;
let categoryValidation = false;

if(AllArticles.length === 0) getAllArticles();

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
    let contentRegex = /^[A-Za-z0-9\s.?,!()\-–'":\[\]]{50,60000}$/;

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
    let titleRegex = /^[A-Za-z0-9\s()]{10,100}$/;

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
    let article = searchArticlesById(id);
    document.getElementById("article-title").value = article.title;
    document.getElementById("article-content").value = article.content;
    document.getElementById("article-author").value = article.id_author;
    document.getElementById("article-category").value = article.id_category;
    document.getElementById("submit-article").setAttribute('onclick', `updateArticle(${id})`);
    document.getElementById("submit-article").innerText = "Update article";
    document.getElementById("title-model").innerText = "Updating article";
    document.getElementById("Add-another-article").classList.add("hidden");

}

function restFormArticle() {
    document.getElementById("article-title").value = "";
    document.getElementById("article-content").value = "";
    document.getElementById("article-author").value = "";
    document.getElementById("article-category").value = "";
    document.getElementById("submit-article").setAttribute('onclick', `saveArticle()`);
    document.getElementById("submit-article").innerText = "Save article(s)";
    document.getElementById("title-model").innerText = "Adding new articles";
    document.getElementById("Add-another-article").classList.remove("hidden");

}

function overviewArticle(id) {
    window.location.href=`http://localhost:8080/src/admin/article-view.php?id=${id}`;
}

function deleteArticle(id) {

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
                    if(data === "true"){
                        notify.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                        getAllArticles();
                    }
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

function getAllArticles() {
    getMapping(`http://localhost:8080/src/includes/router.php?getAllArticles=1`)
        .then( res => res.json())
        .then( data => {
                console.log(data)
                setArticles(data)
            }
        )
}

function setArticles(data) {
    AllArticles = data;
}

function updateArticle(id) {
    let article = getFormData();
    article.id = id;

    if(titleValidation && contentValidation && authorValidation && categoryValidation) {
        postMapping("http://localhost:8080/src/includes/router.php?updateArticle=1", article)
            .then(res => res.text())
            .then(data => {
                console.log(data)
                if (data === "true") {
                    notify.fire(
                        'Updated!',
                        'Your file has been updated.',
                        'success'
                    )
                    setTimeout(()=>{
                            window.location.href = "http://localhost:8080/src/admin/article.php";
                        },
                        2000
                    )
                } else
                    notify.fire(
                        'Error !',
                        'some error is occurred! article is not updated !',
                        'error'
                    )
            })
    }
}

function searchArticlesById(id){
    let res = null;
    AllArticles.forEach(e=>{
        if(e.id === id)
            res=e;
    })
    return res;
}

function searchArticles() {


    let searchArticleValue = document.getElementById("search-article").value;
    let reg = /^[a-zA-Z0-9\s]+$/
    if(reg.test(searchArticleValue) || searchArticleValue === '' )
    {
        document.getElementById("notify-search-article").innerText = "";
        getMapping(`http://localhost:8080/src/includes/router.php?searchArticle=${searchArticleValue}`)
            .then(res => res.json())
            .then(data => {
                    insertArticlesToHtml(data)
                }
            )
    }
    else
        document.getElementById("notify-search-article").innerText = "character and numbers is only allowed here";
}

function insertArticlesToHtml(articlesToInsert) {
    const tableArticles = document.getElementById("body-articles")
    let dataStructure = "";
    articlesToInsert.forEach( article =>{
        dataStructure+= `
                    <tr>
                        <td> ${article.title} </td>
                        <td> ${article.author} </td>
                        <td> ${article.published_date} </td>
                        <td>
                            <div class="flex gap-8">
                                <button class="bg-transparent text-green-600 bg-white"
                                        data-modal-target="article-modal"
                                        data-modal-toggle="article-modal"
                                        onclick="editArticle(${article.id})"
                                    >
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="bg-transparent text-red-700 bg-white" onclick="deleteArticle(${article.id})">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <button class="bg-transparent text-blue-700 bg-white" onclick="overviewArticle(${article.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
        `
    })

    tableArticles.innerHTML = dataStructure;
}

function sortArticles() {
    let sortList = document.getElementById("sort-attr");
    let sortMethod = document.getElementById("sort-meth");
    let Url = 'http://localhost:8080/src/includes/router.php?getAllArticles=1';
        if(['id', 'title', 'content', 'author', 'published_date'].includes(sortList.value))
    {
        Url += `&sort=${sortList.value}`;
        if(['asc', 'desc'].includes(sortMethod.value)){
            Url += `&meth=${sortMethod.value}`;
        }
        getMapping(Url)
            .then(res=>res.json())
                .then(data=>{
                    setArticles(data)
                    insertArticlesToHtml(data)
                })
    }
    else
    {
        console.error("Not found");
    }
}