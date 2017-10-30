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
        $article = "";
        $errors = [];
        $success = [];
        $uploadErrors = [];
        $allErrors = [];

        if (!empty($_POST)) {

            $article = $_POST;
            $articleBlog = new ArticleBlog();

            if (empty($_POST['title'])) {
                $errors[] = "Veuillez ajouter un titre";
            }

            $articleBlog->setTitle($_POST['title']);

            if (empty($_POST['date'])) {
                $errors[] = 'Veuillez ajouter la date';
            }

            $articleBlog->setDate($_POST['date']);

            if (empty($_POST['articleBlogSummernote'])) {
                $errors[] = 'Veuillez ajouter le texte de votre article';
            }

            $articleBlog->setContent($_POST['articleBlogSummernote']);

//            for ($i = 0; $i < count($_FILES['articleBlogFile']['name']); $i++) {
            if (empty($errors)) {

                $uploadManager = new UploadManager($_FILES);
                $uploadErrors = $uploadManager->filesUploads();

                if (empty($uploadErrors)) {
                    $path = $uploadManager->getUrlPicture();

                    $articleBlogManager = new ArticleBlogManager();
                    $articleBlogId = $articleBlogManager->add($articleBlog);


                        $articleImage = new Image();
                        $articleImage->setPath($path);
                        $articleImage->setArticleBlogId($articleBlogId);
                        $articleImage->setisPrincipal(false);
                        $addArticleImage = new ImageManager();
                        $addArticleImage->addImage($articleImage);
                        $success [] = 'L\'article a bien été ajouté';
//                    }
                }
            }
        }

        $allErrors = array_merge($errors, $uploadErrors);

        $myFiles = [];
        $it = new \FilesystemIterator(__DIR__ . '/../../public/uploads');
        foreach ($it as $fileInfo) {
            $myFiles[] =  $fileInfo->getFilename();
        }

        return $this->twig->render('Admin/Blog/adminBlogAddArticle.html.twig', [
            'errors' => $allErrors,
            'success' => $success,
            'article' => $article,
            'myFiles' => $myFiles,
            'route' => $_GET['route'],
        ]);
    }

    public function listAction()
    {
        $articleBlogManager = new ArticleBlogManager();
        $listArticles = $articleBlogManager->findAll();

        return $this->twig->render('Admin/Blog/adminBlogList.html.twig', [
            'articlesBlog' => $listArticles
        ]);
    }

}