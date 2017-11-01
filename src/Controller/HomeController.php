<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 13/10/17
 * Time: 11:31
 */


namespace AtelierO\Controller;

use AtelierO\Model\AboutUsManager;
use AtelierO\Model\Image;
use AtelierO\Model\ImageManager;
use GuzzleHttp\Client;
use GuzzleHttp\EntityBody;

class HomeController extends Controller
{
    public function showAction()
    {
        $errors = [];
        $mail = '';

        if (!empty($_POST) AND isset($_POST['mailForm'])) {
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
                $transport = new \Swift_SmtpTransport(SWIFTMAILSERVER, SWIFTMAILPORT, SWIFTMAILSECURITY);
                $transport->setUsername(SWIFTMAILUSER)
                    ->setPassword(SWIFTMAILPASSWORD);

                // Create the Mailer using your created Transport
                $mailer = new \Swift_Mailer($transport);

                // Create a message
                $message = (new \Swift_Message('Message venant de www.ateliero.com'))
                    ->setFrom([$mailExpe => $name])
                    ->setTo(SWIFTMAILRECIPIENT)
                    ->setBody($body);

                // Send the message
                $mailer->send($message);

                header('Location:index.php');
            }
        }

        $client = new Client();
        $response = $client->get('https://www.instagram.com/atelier_o/media/');
        $decode = $response->getBody();
        $tabInsta = \GuzzleHttp\json_decode($decode, true);
        foreach ($tabInsta['items'] as $imgInsta)
        {
            $imageInsta[] = $imgInsta['images']['standard_resolution']['url'];
        }
        foreach ($tabInsta['items'] as $imgInsta)
        {
            $urlImageInsta[] = $imgInsta['link'];
        }

        $imgManager = new ImageManager();
        $imgBlog = $imgManager->extractPicture();
        $aboutManager = new AboutUsManager();
        $aboutUs = $aboutManager->findLast();
        return $this->twig->render('Home/home.html.twig', [
            'aboutUs' => $aboutUs,
            'errors' => $errors,
            'mail' => $mail,
            'imgBlog' => $imgBlog,
            'imageInsta' => $imageInsta,
            'urlImageInsta' => $urlImageInsta,
        ]);
    }
}
