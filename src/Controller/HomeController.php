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
use AtelierO\Model\PartnerManager;
use GuzzleHttp\Client;
use GuzzleHttp\EntityBody;

class HomeController extends Controller
{
    public function showAction()
    {

        $errors = [];
        $mail = '';
        $messages = [];

        if (!empty($_SESSION['success'])) {
            if ('mailContactOK' == $_SESSION['success']) {
                $messages['success'][] = "Votre message a bien été envoyé, je reviendrai vers vous dans les meilleurs délais.";
                session_destroy();
            }
        }

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
                $message = (new \Swift_Message('Message venant de www.chloeceramique.com'))
                    ->setFrom([$mailExpe => $name])
                    ->setTo(SWIFTMAILRECIPIENT)
                    ->setBody($body);
                $headers = $message->getHeaders();
                $headers->addIdHeader('Message-ID', "b3eb7202-d2f1-11e4-b9d6-1681e6b88ec1@chloeceramique.com");
                $headers->addTextHeader('MIME-Version', '1.0');
                $headers->addTextHeader('X-Mailer', phpversion());
                $headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);

                // Send the message
                $mailer->send($message);
                $_SESSION['success'] = "mailContactOK";
                header('Location:index.php');
            }
        }

        $partnerManager = new PartnerManager();
        $partners = $partnerManager->findAll();

        $client = new Client();

        // Début du test de connexion à INSTAGRAM
        try {
        $response = $client->get('https://www.instagram.com/' . COMPTEINSTA . '/media/');
        $decode = $response->getBody();
        $tabInsta = json_decode($decode, true);
        foreach ($tabInsta['items'] as $imgInsta)
        {
            $imageInsta[] = $imgInsta['images']['standard_resolution']['url'];
        }
        foreach ($tabInsta['items'] as $imgInsta)
        {
            $urlImageInsta[] = $imgInsta['link'];
        }
        }
        catch (\Exception $e) {
            $imageInsta = [
                "images/instagram/001.jpg",
                "images/instagram/002.jpg",
                "images/instagram/003.jpg",
                "images/instagram/004.jpg",
                "images/instagram/005.jpg",
                "images/instagram/006.jpg",
            ];

            $urlImageInsta = [
                "https://www.instagram.com/p/Ba6ja1GgVia/?taken-by=atelier_o",
                "https://www.instagram.com/p/BalZoyWAGfD/?taken-by=atelier_o",
                "https://www.instagram.com/p/BZ8NcrKATLv/?taken-by=atelier_o",
                "https://www.instagram.com/p/BZ0XIqdgoU9/?taken-by=atelier_o",
                "https://www.instagram.com/p/BZlCyd6gooD/?taken-by=atelier_o",
                "https://www.instagram.com/p/BZgDWshAoDl/?taken-by=atelier_o",
            ];
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
            'partners' => $partners,
            'imageInsta' => $imageInsta,
            'urlImageInsta' => $urlImageInsta,
            'messages' => $messages,
        ]);
    }
}
