<div class="">
  <h1 class="heading">Categories</h1>
  <?php
  include('../common/db.php');
  $query = "SELECT * FROM category";
  $result = $conn->query($query);
  foreach ($result as $row) {
    $name = ucfirst($row['name']);
    $id = $row['id'];
    echo "<div class='row border p-2 m-2'>
        <h4><a href='?c-id=$id' class='text-decoration-none'>$name</a></h4>
       </div>";
  }
  ?>
</div>