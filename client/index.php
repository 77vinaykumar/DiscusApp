<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discuss Project</title>
    <?php include('commonFiles.php') ?>
</head>

<body>
    <?php

    session_start();
    include('header.php');

    if (isset($_GET['signup']) && (!isset($_SESSION['user']) || !isset($_SESSION['user']['username']))) {
        include('signup.php');
    } else if (isset($_GET['login']) && (!isset($_SESSION['user']) || !isset($_SESSION['user']['username']))) {
        include('login.php');
    } else if (isset($_GET['ask']) && isset($_SESSION['user']) && isset($_SESSION['user']['username'])) {
        include('ask.php');
    } else if (isset($_GET['q-id']) /*&& isset($_SESSION['user']) && isset($_SESSION['user']['username'])*/) {
        $q_id = $_GET['q-id'];
        include('question-details.php');
    } else if (isset($_GET['c-id'])) {
        $cid = $_GET['c-id'];
        include('questions.php');
    } else if (isset($_GET['u-id'])) {
        $uid = $_GET['u-id'];
        include('questions.php');
    } else if (isset($_GET['latest'])) {
        include('questions.php');
    } else if (isset($_GET['search'])) {
        $search = $_GET['search'];
        include('questions.php');
    } else {
        include('questions.php');
    }
    ?>
</body>

</html>