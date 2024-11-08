<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');
checkNotLoginRedirectToAuth();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/header.html'); ?>
</head>

<body class="has-background-light" style="min-height: 100%;">
    <div id="nescss">
        <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/component/navbar.html'); ?>
        <div class="container">
            <main class="main-content">
                <section class="topic">
                    <section class="showcase">
                        <section class="nes-container with-title">

                            <h3 class="title">Send money to someone</h3>
                            <br />
                            <h3 class="subtitle has-text-success">💸 Your current money is: <span id="money"></span> </h3>
                            <h3 class="subtitle">Which user id do you want to send money to?</h3>

                            <br>

                            <form method="POST" onsubmit="set_info(event)"> <!--onsubmit="set_info(event)" chính là event handler trong JavaScript -->
                                <div class="field" style="display: none;">
                                    <input id="sender_id" name="sender_id">
                                </div>
                                <div class="field">
                                    <input id="receiver_id" name="receiver_id" placeholder="Receiver id" class="nes-input" required>
                                </div>
                                <br>
                                <div class="field">
                                    <input id="amount" name="amount" placeholder="Amount" class="nes-input" type="number" required>
                                </div>
                                <br>
                                <div class="field">
                                    <button class="nes-btn is-success" id="submit-btn">
                                        Submit
                                    </button>
                                </div>
                            </form>
                            <p id="message" class="has-text-centered has-text-danger"></p>
                        </section>
                    </section>
                </section>
            </main>
        </div>
        <script src="/static/js/transaction.js"></script>
</body>

</html>