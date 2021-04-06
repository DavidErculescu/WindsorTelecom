<?php
    namespace App\Repository;

    use Doctrine\ORM\EntityRepository;

    class WorkflowStageRepository extends EntityRepository
    {
        public function findAllStages($workflowId)
        {
            $query = $this->createQueryBuilder('ws');

            $query->select(['s.id, ws.order']);

            $query->join('ws.stage', 's');
            $query->join('ws.workflow', 'w');

            $query->where('w.id = :workflow');
            $query->setParameter('workflow', $workflowId);

            $query->orderBy('ws.order');

            $getQuery = $query->getQuery();

            return $getQuery->getResult();
        }
    }