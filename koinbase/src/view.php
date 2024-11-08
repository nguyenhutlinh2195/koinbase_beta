<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');
checkNotLoginRedirectToAuth();

$error = '';
if (!isset($_GET['id'])) {
    header("Location: view.php?id=1");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/header.html'); ?>
</head>

<body>
    <div id="nescss">
        <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/component/navbar.html'); ?>
        <div class="container">
            <main class="main-content">
                <section class="topic">
                    <section class="showcase">
                        <section class="nes-container with-title">

                            <h3 class="title">Profile</h3>
                            <br />

                            <?php if (strlen($error) > 0) {
                                echo '<p class="has-text-centered has-text-danger">';
                                echo $error;
                                echo '</p>';
                            } ?>

                            <div class="field" style="margin-left: auto; margin-right: auto; width: 50%; height: 25%;">
                                <h3 class="has-text-centered">Avatar</h3>
                                <img id="image" width="100%">
                                <div class="level mt-2">
                                    <h3 class=" level-left">User id: </h3>
                                    <h3 class="level-right" id="id"></h3>
                                </div>

                                <div class="level mt-2">
                                    <h3 class=" level-left" id="username">🐱 Username: </h3>
                                </div>

                                <div class="level mt-2">
                                    <h3 class=" level-left" id="credit_card">💳 Credit card: </h3>
                                    <!--- this is encrypted for security purpose -->
                                </div>
                                <label for="bio" class="label">Bio</label>
                                <textarea form="submit-bio-form" id="bio" name="bio" style="width: 100%; height: 200px; padding: 10px" disabled></textarea>
                                <br />


                        </section>
                    </section>
                </section>
        </div>
        </section>
        <script src="/static/js/view.js"></script>
</body>

</html>