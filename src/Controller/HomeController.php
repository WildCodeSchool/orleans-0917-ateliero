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

        // instagram

        $access_token="6660464628.1677ed0.230295a1e199429a87d0b5f3209b8eb3";
        $photo_count=6;
        $json_link="https://api.instagram.com/v1/users/self/media/recent/?";
        $json_link.="access_token={$access_token}&count={$photo_count}";
        $json = file_get_contents($json_link);
        $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        $urlImageInsta = [];
        $imageInsta= [];
        foreach ($obj['data'] as $data){
            $urlImageInsta[] = $data['link'];
            $imageInsta[] = $data['images']['standard_resolution']['url'];
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
