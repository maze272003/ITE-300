<?php
error_reporting(0);
class StudentDashboard
{
  private $userId;
  private $role;

  public function __construct($userId, $role)
  {
    $this->userId = $userId;
    $this->role = $role;
  }

  public function displayDashboard()
  {
    if ($this->role !== 'student') {
      header("Location: test.php");
      exit();
    }

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
require_once("Library/function/bookborrow.php");
$books = new Book();
$category = new Category();
$publisher = new Publisher();
$bookBorrow = new BookBorrow();

$search = array(
  "title" => "",
  "category" => "",
  "publisher" => ""
);

$publisherList = $publisher->getPublisherList();
$bookBorrowList = $books->getBookList($search);
$categoriesList = $category->getCategoryList();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ($_POST['bookId']) {
    $data = array(
      "bookId" => $_POST['bookId'],
      "borrowFrom" => $_POST['borrowFrom'],
      "borrowTo" => $_POST['borrowTo'],
      "borrowerId" => $_SESSION['user_id']
    );
    $response = $bookBorrow->add($data);
  }

  $search = array(
    "title" => $_POST['title'],
    "category" => $_POST['category'],
    "publisher" => $_POST['publisher']

  );
  $bookBorrowList = $books->getBookList($search);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />

  <title>Library Management System</title>

  <style>

  </style>
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
        <li class="nav-item text-white">
          <?php

          echo "Welcome, " . $_SESSION['username'] . "! | ";
          echo "<a href='logout.php'>Logout</a>"
            ?>
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
              <select class="form-control" name="category">
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
              <select class="form-control" name="publisher">
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
        <?php
        if ($response != "") {
          ?>
          <div class="alert alert-success">
            <strong>
              <?php echo $response; ?>!
            </strong>
          </div>
          <?php

        }
        ?>
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

            while ($bookBorrowDetails = mysqli_fetch_assoc($bookBorrowList)) {

              echo '<tr>
                            <td>' . $bookBorrowDetails["Id"] . '</td>
                            <td>' . $bookBorrowDetails["Title"] . '</td>
                            <td>' . $bookBorrowDetails["Description"] . '</td>
                            <td>' . $bookBorrowDetails["Category"] . '</td>
                            <td>' . $bookBorrowDetails["Publisher"] . '</td>
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" onclick="BorrowBookModal(' . $bookBorrowDetails["Id"] . ')" data-toggle="modal" data-target="#borrowModal">Borrow</button>
                            </td>
                          </tr>';
            }


            ?>

          </tbody>
        </table>

        <div class="modal" id="borrowModal">
          <form action="" method="post">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Borrow</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                  <input type="hidden" id="bookId" value="0" name="bookId">
                  <div class="form-group">
                    <label>Borrow From</label>
                    <input type="datetime-local" class="form-control" id="borrowFrom" name="borrowFrom" required>
                  </div>
                  <div class="form-group">
                    <label>Borrow To:</label>
                    <input type="datetime-local" class="form-control" id="borrowTo" name="borrowTo" required>
                  </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  function BorrowBookModal(id) {
    document.getElementById("bookId").value = id;
  }
</script>

</html>