<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {

        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postRepository->findAll();

        return $this->render('homepage.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @route("/post/{id}/show", name="posts")
     */
    public function post(Post $post)
    {

        //$postsRepository = $this->getDoctrine()->getRepository(Post::class);
        //$post = $postsRepository->find($id);

        return $this->render('post.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/post/create") 
     */
    public function create()
    {

        // On crée un objet de type Post
        $post = new Post();
        $post->setTitle("Post 1");
        $post->setBody("Le contenu du post");
        $post->setNbLikes(0);
        $post->setCreatedAt(new \DateTime());

        // On demande a Doctrine de nous donner le gestionnaire d'entités
        $entityManager = $this->getDoctrine()->getManager();
        // On demande au géstionnaire d'entité de prendre en charge cette nouvelle entité
        $entityManager->persist($post);

        // On demande au gestionnaire d'entité de mettre a jours la BDD avec toute les nouveautées qu'on lui a fourni
        $entityManager->flush();

        return $this->render('base.html.twig');
    }

    /**
     * @Route("/post/update") 
     */
    public function update()
    {

        // Je recupère le post que je veux modifier
        $repo = $this->getDoctrine()->getRepository(Post::class);
        // le post récupéré ici est connu de l'entity manager (parce que c'est lui qui garde toutes les reference des objets récupérés depuis la BDD)
        $post = $repo->find(2);

        // je modifie l'objet
        $post->setTitle('Update du titre');

        // mettre a jour la BDD
        // le manager verifie tout les objet dont il a la refernce pour vérifier s'ils ont été modifiés
        // s'il trouve une modification il crée les requete SQL necessaire pour mettre a jour la BDD
        $this->getDoctrine()->getManager()->flush();

        return $this->render('base.html.twig');
    }
    /**
     * @Route("/post/delete/{id}") 
     */
    public function delete($id)
    {


        $repo = $this->getDoctrine()->getRepository(Post::class);

        $post = $repo->find($id);

        $this->getDoctrine()->getManager()->remove($post);

        $this->getDoctrine()->getManager()->flush();

        return $this->render('base.html.twig');
    }

    /**
     * @route("/author/list")
     */
    public function author()
    {

        $authorRepository = $this->getDoctrine()->getRepository(Author::class);

        $author = $authorRepository->findAll();

        return $this->render('authors.html.twig', [
            'author' => $author
        ]);
    }
}
