<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');
checkNotLoginRedirectToAuth();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/header.html'); ?>
    <style>
        .table {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
</head>

<body class="has-background-light" style="min-height: 100%;">
    <div id="nescss">
        <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/component/navbar.html'); ?>

        <div class="container">
            <main class="main-content">
                <section class="topic">
                    <section class="showcase">
                        <section class="nes-container with-title">

                            <h3 class="title">HALL OF FAME</h3>
                            <table class="table" id="hof">
                                <thead id="hof-head">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Money</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="hof-body"></tbody>
                            </table>
                            <h3 id="page-number" style="margin-top: 20px"></h3> 
                            <a href="/?page=1">1</a>
                            <a href="/?page=2">2</a>
                            <a href="/?page=3">3</a>
                            <a href="/?page=4">4</a>
                        </section>
                    </section>
                </section>
            </main>
        </div>
    <script src="/static/js/index.js"></script>

</body>

</html>