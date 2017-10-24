<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 24/10/17
 * Time: 11:36
 */

namespace AtelierO\Controller;

use AtelierO\Model\FormMail;

class FormMailController extends Controller
{
    public function sentForm()
    {
        $errors = [];
        $success = [];

        if (!empty($_POST)) {

            $formMail = new FormMail();

            if (empty($_POST['name'])) {
                $errors[] = "Veuillez renseigner votre nom";
            }

            $formMail->setName($_POST['name']);


            $mailExpe = filter_input(INPUT_POST, 'mailExpe', FILTER_VALIDATE_EMAIL);

            if ($mailExpe === false) {
                $errors[] = "Le mail fourni n'est pas valide";
            } elseif ($mailExpe === null) {
                $errors[] = "Veuillez renseigner votre adresse mail";
                }

            $formMail->setMailExpe($_POST['mailExpe']);

            if (empty($_POST['message'])) {
                $errors[] = "Veuillez écrire votre message";
            }

            $message = $formMail->setMessage($_POST['message']);

            $to = 'wildoproject@gmail.com';
            $formMail->setTo($to);

            $subject = 'Message envoyé depuis votre site internet.';
            $formMail->setSubject($subject);

            $headers = "From: ". $_POST['name'] . " " . $_POST['mailExpe'];
            $formMail->setHeaders($headers);

            if (empty($errors)) {

                mail($to, $subject, $message, $headers);

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
