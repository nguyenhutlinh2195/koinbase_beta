<?php
header('Content-Type: application/json');
include_once($_SERVER["DOCUMENT_ROOT"] . '/libs/common.php');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'transfer_money':
            if (isset($_POST['sender_id'])) {
                $user = getinfoFromUserid($_POST['sender_id']); //sink với $user là untrusted data do lấy từ thông số sender_id, xảy ra IDOR nếu không kiểm tra kỹ lưỡng. if (isset($_POST['sender_id']) and $user['id'] = $_POST['sender_id']))
            } else {
                $error = "Something is wrong";
            }

            if (!isset($error) && isset($_POST['receiver_id']) && isset($_POST['amount'])) {
                $amount = intval($_POST['amount']);
                if ($amount < 0) {
                    $error = "Nice try, you cannot specify negative amount :D";
                } else {
                    $ourMoney = intval($user['money']);
                    if ($amount > $ourMoney) {
                        $error = "You do not have enough money";
                    } else {
                        $otherPerson = getInfoFromUserId($_POST['receiver_id']); //sink
                        if ($otherPerson === NULL) {
                            $error = "User id not found";
                        } else {
                            if ($otherPerson['id'] === $user['id']) {
                                $error = "You cannot transfer money to yourself";
                            } else {
                                $otherPersonMoney = intval($otherPerson['money']);
                                updateUserMoney($user['id'], $ourMoney - $amount);
                                updateUserMoney($otherPerson['id'], $otherPersonMoney + $amount);
                            }
                        }
                    }
                }
            }
            if (isset($error))
                die(msgToJSON(400, $error));
            else 
                die(msgToJSON(200, "Transfer money success"));
    }
}
else {
    echo msgToJSON(400, "Action not found");
}