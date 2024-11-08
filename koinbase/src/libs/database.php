<?php
if (getenv('APP_ENV') === 'dev') {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}

$conn = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));
$defaultAvatar = getenv('UPLOAD_URL') . "/upload/default.png";

function execQuery($query)
{
    global $conn;
    try {
        $sth = $conn->query($query);
        return $sth;
    } catch (Exception $e) {
    }
};

function selectAll($query)
{
    $res = execQuery($query);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function selectOne($query)
{
    $res = execQuery($query);
    if ($res)
        return $res->fetch_assoc();
    else 
        return false;
}

function getUserFromUsername($username) {
    return selectOne("SELECT id, username, password FROM users WHERE username='" . $username . "' LIMIT 1");
}

function getDetailFromUsername($username) {
    return selectOne("SELECT id, username, money, image, enc_credit_card, bio FROM users where username='" . $username . "' LIMIT 1");
}

function getInfoFromUserId($id) {
    return selectOne("SELECT id, username, money, image, enc_credit_card, bio FROM users WHERE id=" . $id . " LIMIT 1");
}

function getTopUsersByMoney($number) {
    return selectAll("SELECT id, username, money FROM users WHERE money >= 0 ORDER BY money DESC LIMIT " . $number);
}

function insertIntoUser($username, $password) {
    return execQuery("INSERT INTO users(username, password) VALUES ('" . $username . "','" . $password . "')");
}

function updateUserMoney($id, $money) {
    return execQuery("UPDATE users SET money=" . $money . " WHERE id=" . $id);
}

function updateUserImage($id, $image) {
    return execQuery("UPDATE users SET image='" . $image ."' WHERE id=" .$id);
}
function updateUserBio($id, $bio) {
    return execQuery("UPDATE users SET bio='" . $bio . "' WHERE id=" . $id);
}
function updateUserCard($id, $card) {
    return execQuery("UPDATE users set enc_credit_card='" .$card ."' WHERE id=" .$id);
}
