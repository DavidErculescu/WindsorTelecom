<?php
    namespace App\Entity;
    
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Workflow
     *
     * @ORM\Table(name="workflow_stages")
     * @ORM\Entity(repositoryClass="App\Repository\WorkflowStageRepository")
     */
    class WorkflowStageEntity
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\ManyToOne(targetEntity="StageEntity")
         * @ORM\JoinColumn(name="stage_id", referencedColumnName="id")
         */
        private $stage;

        /**
         * @ORM\ManyToOne(targetEntity="WorkflowEntity")
         * @ORM\JoinColumn(name="workflow_id", referencedColumnName="id")
         */
        private $workflow;

        /**
         * @ORM\ManyToOne(targetEntity="ActionEntity")
         * @ORM\JoinColumn(name="action_id", referencedColumnName="id", nullable=true)
         */
        private $action;

        /**
         * @var string
         *
         * @ORM\Column(name="order", type="text")
         */
        private $order;

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @param int $id
         */
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getStage()
        {
            return $this->stage;
        }

        /**
         * @param mixed $stage
         */
        public function setStage($stage): void
        {
            $this->stage = $stage;
        }

        /**
         * @return mixed
         */
        public function getWorkflow()
        {
            return $this->workflow;
        }

        /**
         * @param mixed $workflow
         */
        public function setWorkflow($workflow): void
        {
            $this->workflow = $workflow;
        }

        /**
         * @return mixed
         */
        public function getAction()
        {
            return $this->action;
        }

        /**
         * @param mixed $action
         */
        public function setAction($action): void
        {
            $this->action = $action;
        }

        /**
         * @return string
         */
        public function getOrder(): string
        {
            return $this->order;
        }

        /**
         * @param string $order
         */
        public function setOrder(string $order): void
        {
            $this->order = $order;
        }
    }
