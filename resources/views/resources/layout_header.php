<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title; ?></title>
    <!-- Loaded CDN's -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <!-- Personal files -->
    <script src="javascript/main.js"></script>
    <script src="javascript/delete_item.js"></script>
    <script src="javascript/delete_pack.js"></script>
    <script src="javascript/delete_contact.js"></script>
    <link rel="stylesheet" href="styles/layout.css">
</head>
<body>
    <div class="container">
        <?= "<div class='page-header'><h1>{$page_title}</h1></div>"; ?>

    <!-- Layout used for multiple files. Closes in layout_footer.php -->