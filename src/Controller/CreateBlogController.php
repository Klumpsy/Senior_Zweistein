<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AddBlog;
use App\Form\AddBlogFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateBlogController extends AbstractController
{

    #[Route('/create', name: 'create-blog')]
    public function createBlog(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new AddBlog();

        $form = $this->createForm(AddBlogFormType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->render('blogs/succesfull_blog.html.twig', [
                'post' => $post,
            ]);
        }

        return $this->renderForm('blogs/create_blog.html.twig', [
            'new_blog' => $form,
        ]);
    }
}
