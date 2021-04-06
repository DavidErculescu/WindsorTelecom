<?php
    namespace App\Repository;

    use Doctrine\ORM\EntityRepository;
    use function Symfony\Component\Translation\t;

    class OrderRepository extends EntityRepository
    {
        public function getCurrentStageAction($orderId)
        {
            $query = $this->createQueryBuilder('o');

            $query->select('a.id');

            $query->join('App:WorkflowStageEntity', 'ws');
            $query->join('ws.action', 'a');
            $query->where('o.workflow = ws.workflow');
            $query->andWhere('o.id = :orderId');
            $query->andWhere('o.stage = ws.stage');

            $query->setParameter('orderId', $orderId);

            $result = $query->getQuery()->getResult();

            return $result;
        }

        public function getCurrentStageOrder($orderId)
        {
            $query = $this->createQueryBuilder('o');

            $query->select('ws.order');

            $query->join('App:WorkflowStageEntity', 'ws');
            $query->where('o.workflow = ws.workflow');
            $query->andWhere('o.id = :orderId');
            $query->andWhere('o.stage = ws.stage');

            $query->setParameter('orderId', $orderId);

            $result = $query->getQuery()->getSingleScalarResult();

            return $result;
        }

        public function getNextStage($orderId, $nextStageOrder)
        {
            $query = $this->createQueryBuilder('o');

            $query->select('s.id');

            $query->join('App:WorkflowStageEntity', 'ws');
            $query->join('ws.stage', 's');
            $query->where('o.workflow = ws.workflow');
            $query->andWhere('o.id = :orderId');
            $query->andWhere('ws.order = :nextStageOrder');

            $query->setParameter('nextStageOrder', $nextStageOrder);
            $query->setParameter('orderId', $orderId);

            $result = $query->getQuery()->getResult();

            return $result;
        }
    }