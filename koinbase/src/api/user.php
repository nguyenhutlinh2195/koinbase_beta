<?php
header('Content-Type: application/json');
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    switch ($action) {
        case 'public_info': {
                if (isset($_GET['id'])) {
                    $data = getInfoFromUserId($_GET['id']); //sink SQLi, id là untrusted data, ko có filter được đưa thẳng vào câu query SQL. Phải có hàm kiểm tra id là số "if (isset($_GET['id']) && is_numeric($_GET['id']))"
                    if ($data) {
                        unset($data['enc_credit_card']);
                        echo msgToJSON(200, $data);
                    }
                    else {
                        echo msgToJSON(400, "User not found");
                    }
                } else {
                    echo msgToJSON(400, "Missing params");
                }
                break;
            }
        case 'detail_info': {
                checkNotLoginReturnError();
                $user = getDetailFromUsername($_SESSION['username']);
                if ($user['enc_credit_card'] !== '') { 
                    $user['plain_credit_card'] = xorString(base64_decode($user['enc_credit_card']), $XOR_KEY);
                    unset($user['enc_credit_card']);
                }
                if (intval($user['money']) > 1000000) {
                    $user['flag'] = "Flag 4: CBJS{day_la_fake_flag}";
                    if ($user['id'] == '1') {
                        $user['flag'] = "Admin does not need the flag but the millionaires will";
                    }
                }
                unset($user['enc_credit_card']);
                echo msgToJSON(200, $user);
                break;
            }
        case 'update_info': {
                checkNotLoginReturnError();
                $user = getDetailFromUsername($_SESSION['username']);
                if (isset($_POST['bio']) && $_POST['bio'] != '') {
                    try {
                        updateUserBio($user['id'], $_POST['bio']);
                    } catch (Exception $e) {
                        $error = 'Cannot update bio:';
                    }
                }
                if (isset($_POST['image']) && $_POST['image'] != '') {
                    try {
                        updateUserImage($user['id'], $_POST['image']);
                        $user['image'] = $_POST['image'];
                    } catch (Exception $e) {
                        $error = 'Cannot update avatar';
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
                if (isset($error)) {
                    echo msgToJSON(500, $error);
                } else
                    echo msgToJSON(200, "Update success");
                break;
            }
        case 'hall_of_fame': {
                $hallOfFameUsers = getTopUsersByMoney(20);
                echo msgToJSON(200, $hallOfFameUsers);
                break;
            }
        default:
            echo msgToJSON(400, "Wrong action");
            break;
    }
}
else {
    echo msgToJSON(400, "Action not found");
}
