<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Controller
 * @created 25.03.2026 18:32
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/health', name: 'health', methods: ['GET'])]
    public function health(): Response
    {
        return $this->json([
            'status' => 'ok',
            'service' => 'unilogger',
            'version' => '1.0.0',
            'php' => PHP_VERSION,
            'symfony' => \Symfony\Component\HttpKernel\Kernel::VERSION,
            'time' => date('c'),
        ]);
    }

}
