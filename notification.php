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
            'app_id' => '0b618a1d-0f6f-49ec-8c59-61181432bb82',
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
            'app_id' => '0b618a1d-0f6f-49ec-8c59-61181432bb82',
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
        'Authorization: Basic MWJiNGQzNGMtMmFmMi00NGMwLWI5MDItOTlhYWJhNzA5MjNk',
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
