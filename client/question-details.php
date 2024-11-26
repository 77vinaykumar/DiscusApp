<div class="container">
    <h1 class="heading">Question</h1>

    <div class="row">
        <div class="col-8">
            <?php
            if (isset($_GET['q-id'])) {
                $qid = $_GET['q-id'];  // Category ID को fetch करना
                include("../common/db.php");

                // सवाल के लिए category_id और अन्य details fetch करना
                $query = "SELECT * FROM questions WHERE id = $qid";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {  // Check if result exists
                    $row = $result->fetch_assoc();  // Fetch the question details
                    $cid = $row['category_id'];  // Get the category_id for later use
                    echo "<h4 class='mb-3 question-title'>Question: " . $row['title'] . "</h4>
                          <p class='mb-3'>" . $row['description'] . "</p>";
                } else {
                    echo "<p>No questions available for this category</p>";  // Message if no questions
                }
            }

            include("answer.php");
            ?>
            <form action="../server/requests.php" method="post">
                <input type="hidden" name="question_id" value="<?php echo $qid; ?>">
                <textarea name="answer" placeholder="Type answer..." class="form-control mb-2"></textarea>
                <button class="btn btn-primary">Write your answer</button>
            </form>
        </div>
        <div class="col-4">
            <?php
            if (isset($cid)) {  // Ensure $cid is set before querying
                $categoryQuery = "SELECT name FROM category WHERE id=$cid";
                $categoryResult = $conn->query($categoryQuery);
                $categoryRow = $categoryResult->fetch_assoc();
                echo "<h1>" . ucfirst($categoryRow["name"]) . " Questions</h1>";
                $query = "SELECT * FROM questions WHERE category_id =$cid and id!=$qid";
                $result = $conn->query($query);
                foreach ($result as $row) {
                    $id = $row['id'];
                    $title = $row['title'];
                    echo "<div>
                          <h4><a href='?q-id=$id' class='text-decoration-none'>$title</a></h4>
                          </div>";
                }
            } else {
                echo "<p>No other questions available in this category.</p>";
            }
            ?>
        </div>
    </div>
</div>