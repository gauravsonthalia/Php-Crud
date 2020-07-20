<?php

$insert = false;
$update = false;
$delete = false;
//Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Connection Object
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
  die("Sorry we failed to connect :" .mysqli_connect_error());
}

if (isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `contacts` WHERE `serial_number` = $sno";
  $result = mysqli_query($conn, $sql);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_POST['snoedit'])){
    $sno = $_POST["snoedit"];
    $first_name = $_POST["first_name_edit"];
    $middle_name = $_POST["middle_name_edit"];
    $last_name = $_POST["last_name_edit"];
    $contact_number = $_POST["phone_edit"];
  
    $sql = "UPDATE `contacts` SET `middle_name` = '$middle_name', `first_name` = '$first_name', `last_name` = '$last_name', `contact_number` = '$contact_number' WHERE `contacts`.`serial_number` = $sno";
    $result = mysqli_query($conn, $sql);

    if (result){
      $update = true;
    }
  }
  else{
  $first_name = $_POST["first_name"];
  $middle_name = $_POST["middle_name"];
  $last_name = $_POST["last_name"];
  $contact_number = $_POST["phone"];

  $sql = "INSERT INTO `contacts` (`first_name`, `middle_name`, `last_name`, `contact_number`) VALUES ('$first_name', '$middle_name', '$last_name', '$contact_number')";
  $result = mysqli_query($conn, $sql);

  if($result){
    // echo "Record was inserted Successfully";
    $insert = true;
  }
  else{
    echo "Record was not successfully inserted". mysqli_error($conn);
  }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <title>Php CRUD Operations</title>

  </head>
  <body>
  <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
</button> -->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/crud/index.php" method="post">
      <input type="hidden" name="snoedit" id="snoedit">
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="first_name_edit">First Name</label>
    <input type="text" class="form-control" id="first_name_edit" name="first_name_edit">
  </div>
  <div class="form-group col-md-6">
    <label for="middle_name_edit">Middle Name</label>
    <input type="text" class="form-control" id="middle_name_edit" name="middle_name_edit">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="last_name_edit">Last Name</label>
    <input type="text" class="form-control" id="last_name_edit" name="last_name_edit">
  </div>
  <div class="form-group col-md-6">
    <label for="phone_edit">Contact Number</label>
    <input type="tel" class="form-control" id="phone_edit" name="phone_edit">
  </div>
</div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Php CRUD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php
if ($insert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success ! </strong>Your Contact have been saved.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<?php
if ($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success ! </strong>Your Contact has been updated.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<?php
if ($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success ! </strong>Your Contact have been deleted.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<div class="container my-3">
<h3>Add Contact</h3>
<form action="/crud/index.php" method="post">
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name">
  </div>
  <div class="form-group col-md-6">
    <label for="middle_name">Middle Name</label>
    <input type="text" class="form-control" id="middle_name" name="middle_name">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name">
  </div>
  <div class="form-group col-md-6">
    <label for="phone">Contact Number</label>
    <input type="tel" class="form-control" id="phone" name="phone">
  </div>
</div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>

<div class="conatiner">

  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Serial Number</th>
      <th scope="col">First Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sql = "SELECT * FROM `contacts`";
$result = mysqli_query($conn, $sql);
$sno = 0;
while ($row = mysqli_fetch_assoc($result)){
  $sno = $sno + 1;
  echo "<tr>
  <th scope='row'>". $sno. "</th>
  <td>". $row['first_name']. "</td>
  <td>". $row['middle_name']. "</td>
  <td>". $row['last_name']. "</td>
  <td>". $row['contact_number']. "</td>
  <td><button class='edit btn btn-sm btn-primary' id = ". $row['serial_number']. ">Edit</button> <button class='delete btn btn-sm btn-primary' id = d". $row['serial_number']. ">Delete</button></td>
</tr>";
}
?>
  </tbody>
</table>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
    </script>
        <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          tr =  e.target.parentNode.parentNode;
          first_name = tr.getElementsByTagName("td")[0].innerText;
          middle_name = tr.getElementsByTagName("td")[1].innerText;
          last_name = tr.getElementsByTagName("td")[2].innerText;
          contact_number = tr.getElementsByTagName("td")[3].innerText;
          first_name_edit.value = first_name;
          middle_name_edit.value = middle_name;
          last_name_edit.value = last_name;
          phone_edit.value = contact_number;
          snoedit.value = e.target.id;
          $('#editModal').modal('toggle');
        });
      });

      delets = document.getElementsByClassName('delete');
      Array.from(delets).forEach((element) => {
        element.addEventListener("click", (e) => {
          snodel = e.target.id.substr(1,);
        
        if (confirm("Are you sure you want to delete record !")){
          console.log('yes');
          window.location = `/crud/index.php?delete=${snodel}`;
        }
        else{
          console.log('no');
        }
        });
      });
    </script>
  </body>
</html>