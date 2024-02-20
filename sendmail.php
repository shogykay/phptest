<?php

use Mailtrap\Config;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Mailtrap\EmailHeader\CategoryHeader;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apiKey = 'fa225a31f982fa9cea52c0812e9d8bc4';
    $mailtrap = new MailtrapClient(new Config($apiKey));

    $sender_name = $_POST['Name'];
    $sender_phone = $_POST['Phone'];
    $sender_email = $_POST['Email'];
    $sender_message = $_POST['Message'];

    $email = (new Email())
        ->from(new Address('mailtrap@fernstreetsettlement.org', 'Mailtrap Test'))
        ->to(new Address("oluwasogokenny@gmail.com"))
        ->subject('You have a new message from your website')
        ->text("Name: $sender_name\nPhone: $sender_phone\nEmail: $sender_email\nMessage: $sender_message")
    ;

    $email->getHeaders()
        ->add(new CategoryHeader('Integration Test'))
    ;

    $response = $mailtrap->sending()->emails()->send($email);

    $result = ResponseHelper::toArray($response);

    // Handle the response as per your requirements
    var_dump($result);
}
?>

