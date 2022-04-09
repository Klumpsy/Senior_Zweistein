<?php

namespace App\Controller;

use App\Entity\AddBlog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class MostRecentController extends AbstractController
{

    #[Route('/most-recent', name: 'most-recent')]
    public function mostRecent(ManagerRegistry $doctrine): Response
    {
        $blogs = $doctrine->getRepository(AddBlog::class)->findAll();

        if (!$blogs) {
            throw $this->createNotFoundException('Sorry, er zijn geen blogs');
        }
        return $this->render('most_recent/most_recent.html.twig', [
            'blogs' => array_reverse($blogs)
        ]);
    }
}
