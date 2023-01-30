<?php
    include_once '../includes/autoload.php';
class CategoryController
{
    public function getAllCategories():array{
        return Database::connect()->query("select * from category")->fetchAll();
    }

    public function createCategory(Category $category):bool{
        if(!preg_match("/^[a-zA-Z\s]+$/", $category->getName()))
            return false;
        return Database::connect()->prepare("insert into category values (null, ?)")
            ->execute(array($category->getName()));
    }
    public function updateCategory(Category $category):bool{
        if(!preg_match("/^[a-zA-Z0-9\s]+$/", $category->getName()))
            return false;
        return Database::connect()->prepare("update category set name = ? where id = ?")
            ->execute(array($category->getName(), $category->getId()));
    }

    public function deleteCategory($id): bool{
        $conn = Database::connect();
        $query = "DELETE FROM category WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public static function searchCategories(string $data):array
    {
        $query = "select * from category where name like '%".$data."%'";
        return Database::connect()->query($query)->fetchAll();
    }
}

if(!session_id())
    session_start();

$categoryController = new CategoryController();
if(isset($_POST['save-category'])){
    if( !empty($_POST['category-name']) && preg_match("/^[a-zA-Z0-9_\s]+$/", $_POST['category-name'])) {
        if($categoryController->createCategory(new Category(null, $_POST['category-name'])))
            $_SESSION['message'] = "Category has been created";
        else
            $_SESSION['error'] = "there has been an error!";
    }
    else
        $_SESSION['error'] = "Error in the type of input inserted! characters and numbers is only accepted  !";

    header('Location: ../admin/category.php');
}
if(isset($_POST['update-category'])){
    if(
        !empty($_POST['category-name']) && preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['category-name'])
        && !empty($_POST['id']) &&  is_numeric($_POST['id'])
    ) {
        if($categoryController->updateCategory(new Category( $_POST['id'], $_POST['category-name']) ))
            $_SESSION['message'] = "Category has been updated";
        else
            $_SESSION['error'] = "there has been an error!";
    }
    else
        $_SESSION['error'] = "Error in the type of input inserted! characters and numbers is only accepted ";

    header('Location: ../admin/category.php');
}

$data = json_decode(file_get_contents('php://input'), true);
if(isset($data['delete_category'])){
    if( is_numeric($data['delete_category']))
        try{
            echo $categoryController->deleteCategory($data['delete_category'])? "true":"false";
            $_SESSION['message'] = "Category has been Deleted";
        }catch (Exception $e){
            $_SESSION['error'] = "there was an error in deleting the category!";
        }
    else{
        echo "false";
        $_SESSION['error'] = "there was an error in deleting the category!";
    }
}
if(isset($data['search_categories'])){
    if($data['search_categories'] && preg_match("/^[a-zA-Z0-9\s]+$/", $data['search_categories'] ))
        try{
            echo json_encode(CategoryController::searchCategories($data['search_categories']));
        }catch(Exception $e){
            echo json_encode("error");
        }
    else
        echo json_encode("false");

}
if(isset($_GET['getAllCategories']))
    echo json_encode( $categoryController->getAllCategories() );