<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    /**
     * @Route("/")
     */
    public function homepage() {
     
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $postRepository->findAll();

        return $this->render('homepage.html.twig', [
            'posts' => $posts
        ]);

    }
}