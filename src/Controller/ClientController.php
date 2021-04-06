<?php
    namespace App\Controller;

    use App\Entity\ClientEntity;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class ClientController extends AbstractController
    {
        /**
         * @Route("/clients", name="list_client", methods="GET")
         */
        public function listClientAction()
        {
            $em = $this->getDoctrine()->getManager();
            $clients = $em->getRepository(ClientEntity::class)->findAll();

            $clientList = array();
            foreach ($clients as $client)
            {
                array_push($clientList,
                    [
                        'id'         => $client->getId(),
                        'first_name' => $client->getFirstName(),
                        'last_name'  => $client->getLastName(),
                        'email'      => $client->getEmail()
                    ]
                );
            }

            return new JsonResponse($clientList);
        }
    }