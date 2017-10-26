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
        $mail = '';

        if (!empty($_POST)) {
            $mail = $_POST;

            $name = ($_POST['name']);
            if (empty($name)) {
                $errors['name'] = "Veuillez renseigner votre nom";
            }

            $mailExpe = $_POST['mailExpe'];
            if (empty($mailExpe)) {
                $errors['mail'] = "Veuillez renseigner votre adresse mail";
            }

            $body1 = $_POST['body'];
            if (empty($body1)) {
                $errors['body'] = "Veuillez écrire votre message";
            }

            $body = "From :" . $name . " <" . $mailExpe . ">" . "\n" . $body1;

            if (empty($errors)) {

                // Create the Transport
                $transport = new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
                $transport->setUsername('wildoproject@gmail.com')
                    ->setPassword('AtelierO6');

                // Create the Mailer using your created Transport
                $mailer = new \Swift_Mailer($transport);

                // Create a message
                $message = (new \Swift_Message('Message venant de www.ateliero.com'))
                    ->setFrom([$mailExpe => $name])
                    ->setTo('wildoproject@gmail.com')
                    ->setBody($body);

                // Send the message
                $mailer->send($message);

                header('Location:index.php');
            }


            return $this->twig->render('Home/home.html.twig', [
                'errors' => $errors,
                'mail' => $mail,
            ]);

        }
    }
}


