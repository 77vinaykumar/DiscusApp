<?php
session_start();
include("../common/db.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = $conn->prepare("INSERT INTO users (`id`,`username`,`email`,`password`,`address`) VALUES (null,?,?,?,?)");
    $user->bind_param('ssss', $username, $email, $password, $address);
    $result = $user->execute();

    if ($result) {
        // Corrected part: Insert user_id into the session using $conn->insert_id
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $conn->insert_id];
        header("Location: /DISCUS/client");
    } else {
        echo "Error in signup";
    }
} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = "";
    $user_id = 0;

    $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->bind_param('ss', $email, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        foreach ($result as $row) {
            $username = $row['username'];
            $user_id = $row['id']; // Fetching the user ID
        }
        // Store user_id in the session
        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user_id];
        header("Location: /DISCUS/client");
    } else {
        echo "Invalid login credentials";
    }
} else if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /DISCUS/client");
} else if (isset($_POST['ask'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user']['user_id'];

    $question = $conn->prepare("INSERT INTO questions (`id`,`title`,`description`,`category_id`,`user_id`) VALUES (null,?,?,?,?)");
    $question->bind_param('ssss', $title, $description, $category_id, $user_id);
    $result = $question->execute();

    if ($result) {
        // Corrected part: Insert user_id into the session using $conn->insert_id
        header("Location: /DISCUS/client");
    } else {
        echo "Question is not added in website";
    }
} else if (isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['user']['user_id'];

    $query = $conn->prepare("INSERT INTO answers (`id`,`answer`,`question_id`,`user_id`) VALUES (null,?,?,?)");
    $query->bind_param('sii', $answer, $question_id, $user_id);
    $result = $query->execute();

    if ($result) {
        header("Location: /DISCUS?q-id=$question_id");
    } else {
        echo "Question is not submitted";
    }
} else if (isset($_GET['delete'])) {
    $qid = $_GET['delete'];
    $query = $conn->prepare("DELETE FROM questions WHERE id = $qid");
    $result = $query->execute();
    if ($result) {
        header("Location: /DISCUS/client");
    } else {
        echo "Question is not deleted";
    }
}
