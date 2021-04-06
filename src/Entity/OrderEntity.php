<?php
    namespace App\Entity;
    
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Order
     *
     * @ORM\Table(name="orders")
     * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
     */
    class OrderEntity
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
         * @ORM\JoinColumn(name="workflow_id", referencedColumnName="id", nullable=true)
         */
        private $workflow;

        /**
         * @ORM\ManyToOne(targetEntity="ClientEntity")
         * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", nullable=true)
         */
        private $client;

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
        public function getClient()
        {
            return $this->client;
        }

        /**
         * @param mixed $client
         */
        public function setClient($client): void
        {
            $this->client = $client;
        }
    }
