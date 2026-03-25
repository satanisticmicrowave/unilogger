<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Controller\Api
 * @created 25.03.2026 18:35
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/log')]
class LogController extends AbstractController
{

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json(["status" => "ok"]);
    }
}
