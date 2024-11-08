<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');
checkNotLoginRedirectToAuth();

$error = '';
$messageBio = '';
$user = getUserFromUsername($_SESSION['username']);

if (!$error) {
    if (isset($_POST['bio']) && $_POST['bio'] != '') {
        try {
            updateUserBio($user['id'], $_POST['bio']);
            $user['bio'] = $_POST['bio'];
            $messageBio = 'Successfully update bio';
        } catch (Exception $e) {
            $error = 'Cannot update bio:';
        }
    }
    if (isset($_POST['credit_card']) && $_POST['credit_card'] != '') {
        try {
            $enc_credit_card = base64_encode(xorString($_POST["credit_card"], $XOR_KEY));
            updateUserCard($user['id'], $enc_credit_card);
        } catch (Exception $e) {
            $error = 'Cannot update credit card';
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/header.html'); ?>

</head>

<body class="has-background-light" style="height: 100%;">
    <div id="nescss">
        <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/component/navbar.html'); ?>
        <div class="container">
            <main class="main-content">
                <section class="topic">
                    <section class="showcase">
                        <section class="nes-container with-title" style="min-height:100%">

                            <h3 class="title">Profile</h3>
                            <br />
                            <div class="field has-text-centered">
                                <h3>Avatar</h3>
                                <img id="image">
                                <h3 id="user-id">USER ID: </h3>
                                <h3 id="username">🐱 Username: </h3>
                                <h3 id="money">💸 Money: </h3>
                                <h3 id="flag">🏁 Flag: You are not millionaire, the flag is not available for you</h3>

                                <div class="field">
                                    <label for="url" class="label">Update your avatar</label>
                                    <input class="nes-input" style="padding: 10px;" id="url" name="url" placeholder="Paste image URL here" required>
                                    <input type="hidden" id="upload-url" name="upload-url" value="https://upload.koinbase.cyberjutsu-lab.tech">
                                </div>
                                <button class="nes-btn is-primary" id="upload-file-btn">Upload</button>
                                <br>
                                <img src="/static/img/loader.gif" id="loading_gif_fetch_image" style="display: none">
                                <Br>
                                <div id="result_fetch_image"></div>

                                <form id="submit-bio-form" method="POST" onsubmit="updateBio(event)"><!--event handler--->
                                    <div class="field">
                                        <label for="credit_card" class="label">💳 Please input your credit card here: </label>
                                        <input style="padding: 10px;" id="credit_card" name="credit_card" value="" required>
                                    </div>

                                    <div class="field">
                                        <label for="bio" class="label">Update bio</label>
                                        <textarea form="submit-bio-form" id="bio" name="bio" style="width: 100%; height: 200px; padding: 10px"></textarea>
                                        <input type="text" hidden name="image" id="img_form">
                                        <button type="submit" class="nes-btn is-success" id="change-bio-btn">Save changes</button>
                                </form>
                                <hr>
                                <p id="msg-success" class="has-text-centered has-text-success">
                                </p>
                                <p id="msg-error" class="has-text-centered has-text-danger">
                                </p>
                            </div>
                            <br />
                        </section>
                    </section>
                </section>
        </div>
        </section>
        <script src="/static/js/profile.js"></script>
</body>

</html>