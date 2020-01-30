<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function homepage() {
     
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postRepository->findAll();

        return $this->render('homepage.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @route("/post/{id}/show", name="posts")
     */
    public function post($id) {
        
        $postsRepository = $this->getDoctrine()->getRepository(Post::class);

        $post = $postsRepository->find($id);

        return $this->render('post.html.twig', [
            'post' => $post
        ]);
    }

      /**
     * @route("/author/list")
     */
    public function author() {
        
        $authorsRepository = $this->getDoctrine()->getRepository(Author::class);

        $authors = $authorsRepository->findAll();

        return $this->render('authors.html.twig', [
            'authors' => $authors
        ]);
    }

 
}