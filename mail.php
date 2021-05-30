<?php


$to_email = "bramekelschot@hotmail.nl";
$subject = "Bevesteging van reservering";
$body = "Uw reservering is geslaagd!";
$headers = "Van: ekelschotbram@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}