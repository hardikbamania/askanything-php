<?php

$to = $_POST["to"];
$title = $_POST["title"];
$message = $_POST["message"];
$img= $_POST["img"];
print_r($_POST);

sendnotification($to, $title, $message, $img);

function sendnotification($to, $title, $message, $img)
{
    $msg = $message;
    $content = array(
        "en" => $msg
    );
    $headings = array(
        "en" => $title
    );
    if ($img == '') {
        $fields = array(
            'app_id' => '14ebb802-c8d2-4adf-a4b3-80167ba7beed',
            "headings" => $headings,
           'include_external_user_ids' => array($to),
            "channel_for_external_user_ids"=> "push",
            'content_available' => true,
            'contents' => $content
        );
    } else {
        $ios_img = array(
            "id1" => $img
        );
        $fields = array(
            'app_id' => '14ebb802-c8d2-4adf-a4b3-80167ba7beed',
            "headings" => $headings,
            'include_external_user_ids' => array($to),
            "channel_for_external_user_ids"=> "push",
            'contents' => $content,
            "big_picture" => $img,
            'content_available' => true,
            "ios_attachments" => $ios_img
        );

    }
    $headers = array(
        'Authorization: Basic ZWY5ZmVjM2QtYjQ3My00MmVlLTk1NDQtZjg4OGZhY2I4YWIy',
        'Content-Type: application/json; charset=utf-8'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    print("$result");
    return $result;
}

?>
