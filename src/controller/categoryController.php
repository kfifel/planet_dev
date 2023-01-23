<?php
    include_once '../includes/autoload.php';
class CategoryController
{
    public function getAllCategories():array{
        return Database::connect()->query("select * from category")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCategory(Category $category):bool{
        if(!preg_match("/^[a-zA-Z\s]+$/", $category->getName()))
            return false;
        return Database::connect()->prepare("insert into category values (null, ?)")
            ->execute(array($category->getName()));
    }

    public function deleteCategory($id): bool{
        $conn = Database::connect();
        $query = "DELETE FROM category WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}

$categoryController = new CategoryController();
if(!session_id())
    session_start();

if(isset($_POST['save-category'])){
    if( !empty($_POST['category-name']) && preg_match("/^[a-zA-Z\s]+$/", $_POST['category-name'])) {
        if($categoryController->createCategory(new Category(null, $_POST['category-name'])))
            $_SESSION['message'] = "Category has been created";
        else
            $_SESSION['error'] = "there has been an error!";
    }
    else
        $_SESSION['error'] = "Error in the input inserted!";

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