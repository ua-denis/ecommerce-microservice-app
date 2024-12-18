<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'order_index')]
    public function index(): Response
    {
        return new Response('Order Service is working!');
    }
}