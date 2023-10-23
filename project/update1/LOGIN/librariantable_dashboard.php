<?php

class LibrarianDashboard {
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
        echo "Welcome, Admin!";
        echo "<br>";
        echo "<a href='logout.php'>Logout</a>";
        include('templates/admin.php');
    }
}

session_start();

      if (isset($_SESSION['user_id'])) {
          $studentDashboard = new LibrarianDashboard($_SESSION['user_id'], $_SESSION['role']);
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
        <div class="mx-auto mt-5">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9.8">
            <h3>Borrowed Books</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>STUDENT_NAME</th>
                        <th>CATEGORY</th>
                        <th>PUBLISHER</th>
                        <th>DUE DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($bookDetails = mysqli_fetch_assoc($booksList)) {
                        echo '<tr>
                                <td>' . $bookDetails["Id"] . '</td>
                                <td>' . $_SESSION['user_name'] . '</td> 
                                <td>' . $bookDetails["Category"] . '</td>
                                <td>' . $bookDetails["Publisher"] . '</td>
                                <td>' . $bookDetails["DueDate"] . ' Due Date</td>
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

