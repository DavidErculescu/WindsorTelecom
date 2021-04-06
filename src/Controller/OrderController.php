<?php
    namespace App\Controller;

    use App\Services\ActionService;
    use App\Services\OrderService;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class OrderController extends AbstractController
    {
        /**
         * @Route("/order/{orderId}/action", name="order_action")
         */
        public function executeOrderAction($orderId, ActionService $actionService)
        {
            $result = $actionService->executeCurrentAction($orderId);

            return new JsonResponse($result);
        }

        /**
         * @Route("/order/{orderId}/progress", name="progress_order", methods="GET")
         */
        public function progressOrderStageAction($orderId, OrderService $orderService, ActionService $actionService)
        {
            $result = $orderService->progressOrder($orderId);

            if (isset($result['success']))
            {
                $actionService->executeCurrentAction($orderId);
            }

            return new JsonResponse($result);
        }

        /**
         * @Route("/order/{orderId}/{stageId}", name="set_order_stage")
         */
        public function setOrderStageAction($orderId, $stageId, OrderService $orderService, ActionService $actionService)
        {
            $result = $orderService->setOrderStage($orderId, $stageId);

            if (isset($result['success']))
            {
                $actionService->executeCurrentAction($orderId);
            }

            return new JsonResponse($result);
        }
    }