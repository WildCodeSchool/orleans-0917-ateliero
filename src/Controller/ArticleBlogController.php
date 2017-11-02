<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 28/10/17
 * Time: 10:43
 */

namespace AtelierO\Controller;

use AtelierO\Model\ArticleBlog;
use AtelierO\Model\ArticleBlogManager;
use AtelierO\Model\ImageManager;
use AtelierO\Service\UploadManager;
use AtelierO\Model\Image;

class ArticleBlogController extends Controller
{
    public function addArticle()
    {
        $messages = [];
        $article = "";

        if (!empty($_POST)) {
            $article = $_POST;
            $articleBlog = new ArticleBlog();

            if (empty($_POST['title'])) {
                $messages['danger'][] = "Veuillez ajouter un titre";
            }

            $articleBlog->setTitle($_POST['title']);

            if (empty($_POST['date'])) {
                $messages['danger'][] = 'Veuillez ajouter la date';
            }

            $articleBlog->setDate($_POST['date']);

            if (empty($_POST['articleBlogSummernote'])) {
                $messages['danger'][] = 'Veuillez ajouter le texte de votre article';
            }

            $articleBlog->setContent($_POST['articleBlogSummernote']);

            if (empty($_FILES['articleBlogFile']['name']['0'])) {
                $messages['danger'][] = 'Veuillez ajouter au minimum une image.';
            }

            if (empty($messages['danger'])) {

                $uploadManager = new UploadManager($_FILES);
                $uploadedFiles = $uploadManager->filesUploads();

                if (!empty($uploadedFiles['danger'])) {
                    $messages = array_merge($messages, $uploadedFiles);
                }

                if (empty($messages['danger'])) {
                    $articleBlogManager = new ArticleBlogManager();
                    $articleBlogId = $articleBlogManager->add($articleBlog);

                    if (!empty($uploadedFiles['filesUploaded'])) {

                        foreach ($uploadedFiles['filesUploaded'] as $key => $value) {
                            $articleImage = new Image();
                            $articleImage->setPath($value);
                            $articleImage->setArticleBlogId($articleBlogId);
                            if (0 == $key) {
                                $articleImage->setisPrincipal(true);
                            } else {
                                $articleImage->setisPrincipal(false);
                            }
                            $addArticleImage = new ImageManager();
                            $addArticleImage->addImage($articleImage);
                        }

                        $_SESSION['success'] = 'newBlogArticle';
                        header('Location: admin.php?route=adminBlogList');
                    }
                }
            }
        }

        return $this->twig->render('Admin/Blog/adminBlogAddArticle.html.twig', [
            'messages' => $messages,
            'article' => $article,
            'route' => $_GET['route'],
        ]);
    }

    public function listAction()
    {
        $messages = [];
        if (!empty($_SESSION['success'])) {
            if ('newBlogArticle' == $_SESSION['success']) {
                $messages['success'][] = "L'article a bien été ajouté";
                session_destroy();
            }
        }

        $articleBlogManager = new ArticleBlogManager();
        $listArticles = $articleBlogManager->findAll();

        return $this->twig->render('Admin/Blog/adminBlogList.html.twig', [
            'articlesBlog' => $listArticles,
            'messages' => $messages,
        ]);
    }
}
