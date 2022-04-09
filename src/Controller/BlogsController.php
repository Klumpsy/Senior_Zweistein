<?php

namespace App\Controller;

use App\Entity\AddBlog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

class BlogsController extends AbstractController
{

    #[Route('/blogs', name: 'blogs')]
    public function getBlogs(ManagerRegistry $doctrine): Response
    {
        $blogs = $doctrine->getRepository(AddBlog::class)->findAll();

        if (!$blogs) {
            throw $this->createNotFoundException('Sorry, er zijn geen blogs');
        }

        return $this->render('blogs/blogs.html.twig', [
            'blogs' => $blogs
        ]);
    }

    #[Route('/blogs/{id}', name: 'blog_id')]
    public function getBlog(ManagerRegistry $doctrine, $id): Response
    {
        $blog = $doctrine->getRepository(AddBlog::class)->find($id);

        return $this->render('blogs/single_blog.html.twig', [
            'blog' => $blog
        ]);
    }

    #[Route('/blogs/delete/{id}', methods: ['GET', 'DELETE'], name: "delete_blog")]
    public function deleteBlogs(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $blog = $entityManager->getRepository(AddBlog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Sorry, er bestaan geen blog met id: ' . $id);
        }
        $entityManager->remove($blog);
        $entityManager->flush();

        return $this->redirectToRoute('blogs');
    }
}
