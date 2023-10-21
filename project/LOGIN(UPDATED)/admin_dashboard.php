<?php

class StudentDashboard {
    private $userId;
    private $role;

    public function __construct($userId, $role) {
        $this->userId = $userId;
        $this->role = $role;
    }

    public function displayDashboard() {
        if ($this->role !== 'admin') {
            header("Location: test.php");
            exit();
        }

        // Student-specific content goes here
        echo "Welcome, Admin!";
        echo "<br>";
        echo "<a href='logout.php'>Logout</a>";
        include('templates/admin.php');
    }
}

session_start();

if (isset($_SESSION['user_id'])) {
    $studentDashboard = new StudentDashboard($_SESSION['user_id'], $_SESSION['role']);
    $studentDashboard->displayDashboard();
} else {
    header("Location: main.php");
    exit();
}

?>
<?php
require_once("Library/function/books.php");
require_once("Library/function/category.php");
require_once("Library/function/publisher.php");
$books = new Book();
$category = new Category();
$publisher = new Publisher();

$search = array(
  "title" => "",
  "category" => "",
  "publisher" => ""
);

$publisherList = $publisher->getPublisherList();
$booksList = $books->getBookList($search);
$categoriesList = $category->getCategoryList();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $search = array(
    "title" => $_POST['title'],
    "category" => $_POST['category'],
    "publisher" => $_POST['publisher']
  );
  $booksList = $books->getBookList($search);
}
print_r($booksLists);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
  <title>Bootstrap Example</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style></style>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">Library Management System</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">

        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-3">
        <h4 class="mt-4">Category</h4>
        <form action="" method="post">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              Title
              <input type="text" class="form-control" id="title" placeholder="Search..." name="title"
                value="<?php echo $search['title']; ?>">
            </li>
            <li class="nav-item">
              Category
              <select class="form-select" name="category">
                <?php
                echo '<option value="">-SELECT-</option>';
                while ($categoryDetails = mysqli_fetch_assoc($categoriesList)) {
                  echo '<option value=' . $categoryDetails["Id"] . ' ' . ($search['category'] == $categoryDetails["Id"] ? "selected" : "") . '>' . $categoryDetails["Name"] . '</option>';
                }
                ?>
              </select>
            </li>
            <li class="nav-item">
              Publisher
              <select class="form-select" name="publisher">
                <?php
                echo '<option value="">-SELECT-</option>';
                while ($publisherDetails = mysqli_fetch_assoc($publisherList)) {
                  echo '<option value=' . $publisherDetails["Id"] . ' ' . ($search['publisher'] == $publisherDetails["Id"] ? "selected" : "") . '>' . $publisherDetails["Name"] . '</option>';
                }
                ?>
              </select>
              <button type="submit" class="mt-3 btn btn-primary btn-block">Search</button>
            </li>
          </ul>
        </form>

        <hr class="d-sm-none" />
      </div>
      <div class="col-sm-8">
        <h3>Books</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title of the book</th>
              <th>Description</th>
              <th>Category</th>
              <th>Publisher</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

              while ($bookDetails = mysqli_fetch_assoc($booksList)) {
                
                echo '<tr>
                      <td>' . $bookDetails["Id"] . '</td>
                      <td>' . $bookDetails["Title"] . '</td>
                      <td>' . $bookDetails["Description"] . '</td>
                      <td>' . $bookDetails["Category"] . '</td>
                      <td>' . $bookDetails["Publisher"] . '</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-primary">Borrow</button>
                      </td>
                    </tr>';
              }
            

            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

