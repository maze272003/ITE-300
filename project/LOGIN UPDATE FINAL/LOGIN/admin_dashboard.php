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
    if ($this->role !== 'admin') {
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

require_once("Library/function/bookborrow.php");

$bookBorrow = new BookBorrow();

$search = array(
  "title" => "",
  "borrower" => "",
);


$bookBorrowList = $bookBorrow->bookborrowlist($search);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $search = array(
    "title" => $_POST['title'],
    "borrower" => $_POST['borrower'],
  );
  $bookBorrowList = $bookBorrow->bookborrowlist($search);
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
        <h4 class="mt-4">Filter</h4>
        <form action="" method="post">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              Title
              <input type="text" class="form-control" id="title" name="title" value="<?php echo $search['title']; ?>">
            </li>
            <li class="nav-item">
              Borrower
              <input type="text" class="form-control" id="title" name="borrower"
                value="<?php echo $search['borrow']; ?>">
            </li>
          </ul>
          <button type="submit" class="mt-3 btn btn-primary btn-block">Search</button>
        </form>

        <hr class="d-sm-none" />
      </div>
      <div class="col-sm-8">
        <h3>Book Borrows

        </h3>

        <table class="table table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title of the book</th>
              <th>Borrow From</th>
              <th>Borrow to</th>
              <th>Borrower</th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ($bookBorrowDetails = mysqli_fetch_assoc($bookBorrowList)) {
              echo '<tr>
                            <td>' . $bookBorrowDetails["id"] . '</td>
                            <td>' . $bookBorrowDetails["Title"] . '</td>
                            <td>' . $bookBorrowDetails["borrowFrom"] . '</td>
                            <td>' . $bookBorrowDetails["borrowTo"] . '</td>
                            <td>' . $bookBorrowDetails["borrower"] . '</td>

                          </tr>';
            }


            ?>

          </tbody>
        </table>
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