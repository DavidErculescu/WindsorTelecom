<?php
    namespace App\Entity;
    
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Order
     *
     * @ORM\Table(name="actions")
     * @ORM\Entity()
     */
    class ActionEntity
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
         *
         * @ORM\Column(name="action", type="json", nullable=true)
         */
        private $action;

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
    }
