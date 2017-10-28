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
//use AtelierO\Service\UploadMultipleManager;

class ArticleBlogController extends Controller
{
    public function addArticle()
    {
        $errors = [];
        $success = [];

        if (!empty($_POST)) {

            $articleBlog = new ArticleBlog();

            if (empty($_POST['title'])) {
                $errors[] = "Veuillez ajouter un titre";
            }

            $articleBlog->setTitle($_POST['title']);

            if (empty($_POST['date'])) {
                $errors[] = 'Veuillez ajouter la date';
            }

            $articleBlog->setDate($_POST['date']);

            if (empty($_FILES['content'])) {
                $errors[] = 'Veuillez ajouter le contenu texte de votre article';
            }

            $articleBlog->setContent($_POST['content']);

            if (empty($errors)) {
                $articleBlogManager = new ArticleBlogManager();
                $articleBlogManager->add($articleBlog);
                $success [] = 'L\'article a bien été ajouté';
            }
        }

        return $this->twig->render('Admin/Blog/adminBlogAddArticle.html.twig', [
            'errors' => $errors,
            'success' => $success,
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