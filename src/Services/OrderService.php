<?php
    namespace App\Services;
    
    use App\Entity\OrderEntity;
    use App\Entity\StageEntity;
    use App\Entity\WorkflowStageEntity;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class OrderService
    {
        protected   $container;
        protected   $em;

        public function __construct(ContainerInterface $container)
        {
            $this->container = $container;
            $this->em = $this->container->get('doctrine')->getManager();
        }

        private function getNextStage($orderId)
        {
            $nextStageOrder = $this->em->getRepository(OrderEntity::class)->getCurrentStageOrder($orderId);
            $nextStage = $this->em->getRepository(OrderEntity::class)->getNextStage($orderId, $nextStageOrder+1);

            if ($nextStage)
            {
                $result = $nextStage[0]['id'];
            }
            else
            {
                $result = [
                    'error' => 'no_stage',
                    'error_description' => 'There are no stages to progress to!'
                ];
            }

            return $result;
        }

        private function checkStage($orderId, $stageId)
        {
            $order          = $this->em->getRepository(OrderEntity::class)->findOneById($orderId);
            $workflowStages = $this->em->getRepository(WorkflowStageEntity::class)->findAllStages($order->getWorkflow()->getId());

            foreach ($workflowStages as $workflowStage)
            {
                if ($workflowStage['id'] == $stageId)
                {
                    $newStage = $workflowStage;
                }

                if ($workflowStage['id'] == $order->getStage()->getId())
                {
                    $currentStage = $workflowStage;
                }
            }

            if (!isset($newStage))
            {
                $result = [
                    'error' => 'incorrect_stage',
                    'error_description' => "This order can't have the selected stage!"
                ];
            }
            elseif($newStage['order'] < $currentStage['order'])
            {
                $result = [
                    'warning' => 'incorrect_stage',
                    'warning_description' => "This order is progressed past this stage!"
                ];
            }
            elseif ($newStage['id'] == $currentStage['id'])
            {
                $result = [
                    'error' => 'incorrect_stage',
                    'error_description' => "This order is already at that stage!"
                ];
            }
            else
            {
                $result = [
                    'success' => 'order_stage',
                    'success_description' => 'The order #'.$order->getId().' was moved to status '.$order->getStage()->getTitle()
                ];
            }

            return $result;
        }

        public function progressOrder($orderId)
        {
            $stageId = $this->getNextStage($orderId);

            $check = $this->checkStage($orderId, $stageId);

            if (isset($check['success']))
            {
                $order = $this->em->getRepository(OrderEntity::class)->findOneById($orderId);
                $stage = $this->em->getRepository(StageEntity::class)->findOneById($stageId);

                $order->setStage($stage);

                $this->em->persist($order);
                $this->em->flush();

                $result = [
                    'success' => 'stage_progressed',
                    'success_description' => 'The order #'.$order->getId().' progressed to status '.$order->getStage()->getTitle()
                ];
            }
            else
            {
                $result = $check;
            }

            return $result;
        }

        public function setOrderStage($orderId, $stageId)
        {
            $check = $this->checkStage($orderId, $stageId);

            if (!isset($check['error']))
            {
                $order = $this->em->getRepository(OrderEntity::class)->findOneById($orderId);
                $stage = $this->em->getRepository(StageEntity::class)->findOneById($stageId);

                $order->setStage($stage);

                $this->em->persist($order);
                $this->em->flush();

                $result = [
                    'success' => 'stage_changed',
                    'success_description' => 'The order #'.$order->getId().' was set to status '.$order->getStage()->getTitle()
                ];
            }
            else
            {
                $result = $check;
            }


            return $result;
        }
    }