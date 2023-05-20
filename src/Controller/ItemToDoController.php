<?php

namespace App\Controller;

use App\Entity\ListToDo;
use App\Entity\User;
use App\Service\ItemProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemToDoController extends AbstractController
{
    public function __construct(
        private ItemProvider $itemProvider,
        private EntityManagerInterface $manager
    )
    {
    }

    #[Route('{user}/lists/{listToDo}', name: 'app-items')]
    public function showItems(ListToDo $listToDo): Response
    {
        $items = $listToDo->getItems()->toArray();
        $parameters = [];
        if ($items) {
            $parameters = $this->itemProvider->transformDataForTwig($items, $listToDo->getId());
        }

        return $this->render('item_to_do/index.html.twig', $parameters);
    }

    #[Route('{user}/lists/{listToDo}/done', name: 'app-item-set-done', methods: ["POST"])]
    public function setDoneItem(Request $request, User $user, ListToDo $listToDo): Response
    {
        if ($user->getId() === $listToDo->getUserId()->getId()) {
            $items = $listToDo->getItems();
            if ($request->isMethod('POST')) {
                $data = $request->request->all();

                foreach ($items as $item) {
                    $itemId = $item->getId();

                    if (isset($data['item_' . $itemId]) && $data['item_' . $itemId] === "on") {
                        $item->setDone(true);
                    } else {
                        $item->setDone(false);
                    }
                }
                $this->manager->flush();
            }
        }

        return $this->redirectToRoute('app-items', [
            'user' => $user->getId(),
            'listToDo' => $listToDo->getId()
        ]);
    }
}
