<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    /**
     * @Route("/pdf-by-author/{id}", name="pdfByAuthor")
     */
    public function pdfByAuthor(AuthorRepository $ar, $id)
    {
        \dump($ar->findByIdWithPdf($id));

        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
}
