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
                $messages['danger'][] = 'Veuillez ajouter un titre';
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
                                $articleImage->setIsPrincipal(true);
                            } else {
                                $articleImage->setIsPrincipal(false);
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

        if (!empty($_SESSION['success'])) {
            if ('deleteBlogArticle' == $_SESSION['success']) {
                $messages['success'][] = "L'article a bien été supprimé";
                session_destroy();
            }
        }

        $articleBlogManager = new ArticleBlogManager();
        $listArticles = $articleBlogManager->findAll();

        return $this->twig->render('Admin/Blog/adminBlogList.html.twig', [
            'articlesBlog' => $listArticles,
            'messages' => $messages,
            'route' => $_GET['route'],
        ]);
    }

    public function deleteAction()
    {
        $articleBlogManager = new ArticleBlogManager();
        $articleBlog = $articleBlogManager->find($_POST['id']);
        $imageManager = new ImageManager();
        $images = $imageManager->findAllImagesToOneArticle($articleBlog->getId());
        $imageManager->deleteAllImageFromArticle($articleBlog);
        $articleBlogManager->delete($articleBlog);

        foreach ($images as $image) {
            $fichier = __DIR__ . "/../../public/uploads/" . $image->getPath();
            if (file_exists($fichier)) {
                if ($fichier != "." AND $fichier != ".." AND !is_dir($fichier)) {
                    unlink($fichier);
                }
            }
        }

        $_SESSION['success'] = 'deleteBlogArticle';
        header('Location: admin.php?route=adminBlogList');
    }

    public function deleteImageBlog($id)
    {
        $imageManager = new ImageManager();
        $image = $imageManager->findOneImageArticle($id);
        $imageManager->deleteOneImageFromArticle($image);
        $fichier = __DIR__ . "/../../public/uploads/" . $image->getPath();
        if (file_exists($fichier)) {
            if ($fichier != "." AND $fichier != ".." AND !is_dir($fichier)) {
                unlink($fichier);
            }
        }
        $_SESSION['success'] = 'deleteImageArticle';
        header('Location: admin.php?route=updateArticleBlog&id=' . $_GET['id']);
    }

    public function updateAction()
    {
        $messages = [];

        $articleBlogManager = new ArticleBlogManager();
        $articleBlog = $articleBlogManager->find($_GET['id']);

        if (!empty($_SESSION['success'])) {
            if ('updateBlogArticle' == $_SESSION['success']) {
                $messages['success'][] = "L'article a bien été modifié";
                session_destroy();
            }
        }

        if (!empty($_SESSION['success'])) {
            if ('deleteImageArticle' == $_SESSION['success']) {
                $messages['success'][] = "L'image a bien été supprimée";
                session_destroy();
            }
        }

        if (!empty($_POST['deleteImage'])) {
            $this->deleteImageBlog($_POST['deleteImage']);
        }

        if (!empty($_POST['updateBlogArticle'])) {

            $articleBlog->setTitle($_POST['title']);
            $articleBlog->setDate($_POST['date']);
            $articleBlog->setContent($_POST['articleBlogSummernote']);

            if (empty($_POST['title'])) {
                $messages['danger'][] = 'Veuillez ajouter un titre';
            }

            if (empty($_POST['date'])) {
                $messages['danger'][] = 'Veuillez ajouter une date';
            }

            if (empty($_POST['articleBlogSummernote'])) {
                $messages['danger'][] = 'Veuillez ajouter le texte de votre article';
            }

            if (empty($messages['danger'])) {

                $articleBlog->setTitle($_POST['title']);
                $articleBlog->setDate($_POST['date']);
                $articleBlog->setContent($_POST['articleBlogSummernote']);

                $imageManager = new ImageManager();
                $imagesArticle = $imageManager->findAllImagesToOneArticle($articleBlog->getId());

                foreach ($imagesArticle as $image) {
                    if ($_POST['is_principal'] == $image->getId()) {
                        $image->setIsPrincipal(true);
                    } else {
                        $image->setIsPrincipal(false);
                    }
                    $imageManager->updateImagesArticleBlog($image);
                }

                $articleBlogManager->update($articleBlog);

                if (!empty($_FILES['articleBlogFile'])) {

                    $uploadManager = new UploadManager($_FILES);
                    $uploadedFiles = $uploadManager->filesUploads();

                    if (!empty($uploadedFiles['danger'])) {
                        $messages = array_merge($messages, $uploadedFiles);
                    }

                    if (empty($messages['danger'])) {
                        foreach ($uploadedFiles['filesUploaded'] as $key => $value) {
                            $articleImage = new Image();
                            $articleImage->setPath($value);
                            $articleImage->setArticleBlogId($_GET['id']);
                            $articleImage->setIsPrincipal(false);
                            $addArticleImage = new ImageManager();
                            $addArticleImage->addImage($articleImage);
                        }
                    }
                }

                if (empty($messages['danger'])) {
                    $_SESSION['success'] = 'updateBlogArticle';
                    header('Location: admin.php?route=updateArticleBlog&id=' . $_GET['id']);
                }
            }
        }

        $imageManager = new ImageManager();
        $imagesArticle = $imageManager->findAllImagesToOneArticle($articleBlog->getId());

        return $this->twig->render('Admin/Blog/adminBlogUpdat.html.twig', ['articleBlog' => $articleBlog,
            'imagesArticleBlog' => $imagesArticle,
            'messages' => $messages,
            'route' => $_GET['route'],
        ]);

    }

}
