<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\ListProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListToDoController extends AbstractController
{
    public function __construct(
        private ListProvider $listProvider
    )
    {
    }

    #[Route('/{user}/lists', name: 'app-lists')]
    public function showLists(User $user): Response
    {
        $lists = $user->getLists()->toArray();
        $parameters = [];
        if ($lists) {
            $parameters = $this->listProvider->transformDataForTwig($lists);
        }

        return $this->render('list_to_do/index.html.twig', $parameters);
    }
}
