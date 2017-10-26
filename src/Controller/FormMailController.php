<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 24/10/17
 * Time: 11:36
 */

namespace AtelierO\Controller;


class FormMailController extends Controller
{
    public function sentForm()
    {
        $errors = [];
        $success = [];

        if (!empty($_POST)) {

            if (empty($_POST['name'])) {
                $errors[] = "Veuillez renseigner votre nom";
            }

            $name = ($_POST['name']);


            $mailExpe = filter_input(INPUT_POST, $_POST['mailExpe'], FILTER_VALIDATE_EMAIL);

            if ($mailExpe === false) {
                $errors[] = "Le mail fourni n'est pas valide";
            } elseif ($mailExpe === null) {
                $errors[] = "Veuillez renseigner votre adresse mail";
                }

            if (empty($_POST['message'])) {
                $errors[] = "Veuillez écrire votre message";
            }

            $message = $_POST['message'];
            $subject = 'Message envoyé depuis le site l\'aelierO.com.';

            $headers = "From: ". $_POST['name'] . " " . $_POST['mailExpe'];


            if (empty($errors)) {

                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
                    ->setUsername('wildoproject@gmail.com')
                    ->setPassword('AtelierO6');


// Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

// Create a message
                $message = (new Swift_Message('Wonderful Subject'))
                    ->setFrom([$mailExpe => $name])
                    ->setTo('wildoproject@gmail')
                    ->setBody($headers, $subject, $message, $headers)
                ;

// Send the message
                $result = $mailer->send($message);


                $success[] = 'L\'email a bien été envoyé';
            }
        }

        $allErrors = array($errors);

        return $this->twig->render('Home/home.html.twig', [
            'errors' => $allErrors,
            'success' => $success,
            'route' => $_GET['route'],
        ]);

    }
}

header('location:../src/View/Home/home.html.twig');
