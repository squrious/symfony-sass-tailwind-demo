<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class IndexController
{
    #[Route('/')]
    #[Template('index.html.twig')]
    public function __invoke()
    {
    }
}
