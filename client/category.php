<select name="category" class="form-control" id="category">
    <option value="">Select A Category</option>
    <?php
    include("../common/db.php");
    $query = "SELECT * FROM category";
    $result = $conn->query($query);
    foreach ($result as $row) {
        $name = ucfirst($row['name']);
        $id = $row['id'];
        echo "<option value='$id'>$name</option>";
    }
    ?>
</select>
</select>