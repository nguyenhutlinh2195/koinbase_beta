<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');

$error = '';
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = getUserFromUsername($username); //untrusted data
            if ($user !== NULL) {
                $dbUsername = $user['username'];
                $dbPassword = $user['password'];
                if ($username === $dbUsername && password_verify($password, $dbPassword)) {
                    $_SESSION['username'] = $username;
                    die(header("Location: /?page=1"));
                } else {
                    $error = 'Wrong username or password';
                }
            } else {
                $error = 'Wrong username or password';
            }
            break;
        case 'signup':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = getUserFromUsername($username);
            if ($user === NULL) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $result = insertIntoUser($username, $password);
                if ($result) {
                    $_SESSION['username'] = $username;
                    die(header("Location: /?page=1"));
                } else {
                    $error = 'Username too long';
                }
            } else {
                $error = 'Username already existed';
            }
            break;
        case 'logout':
            unset($_SESSION['username']);
            die(header('Location: /auth.php'));
    }
} else {
    checkLoginRedirectToHome();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php readfile($_SERVER["DOCUMENT_ROOT"] . '/static/html/header.html'); ?>
</head>

<body>
    <div id="nescss">
        <div class="container">
            <main class="main-content">
                <h1 class="title has-text-centered has-text-black">KoinBase beta<span class="dash_blink"></span></h1>
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                        <form method="POST" class="box">
                            <h1 class="title has-text-centered has-text-black">Login</h1>
                            <div class="field">
                                <label for="username" class="label">Username</label>
                                <input id="username" name="username" type="username" placeholder="" class="nes-input" required>
                            </div>
                            <div class="field">
                                <label for="password" class="label">Password</label>
                                <input id="password" name="password" type="password" placeholder="" class="nes-input" required>
                            </div>
                            <br>
                            <button formaction="/auth.php?action=login" class="nes-btn is-success" type="submit" id="submit-btn">Login</button>
                            <button formaction="/auth.php?action=signup" class="nes-btn is-warning" type="submit">Sign up</button>
                        </form>
                        <p class="has-text-centered has-text-danger">
                            <?php echo $error; ?>
                        </p>
                    </div>
                </div>
        </div>
    </div>
</body>

</html>