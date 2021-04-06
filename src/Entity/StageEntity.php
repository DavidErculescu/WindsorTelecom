<?php
    namespace App\Entity;
    
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Stage
     *
     * @ORM\Table(name="stages")
     * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
     */
    class StageEntity
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
         * @var string
         *
         * @ORM\Column(name="code", type="text")
         */
        private $code;

        /**
         * @var string
         *
         * @ORM\Column(name="title", type="text")
         */
        private $title;

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
         * @return string
         */
        public function getCode(): string
        {
            return $this->code;
        }

        /**
         * @param string $code
         */
        public function setCode(string $code): void
        {
            $this->code = $code;
        }

        /**
         * @return string
         */
        public function getTitle(): string
        {
            return $this->title;
        }

        /**
         * @param string $title
         */
        public function setTitle(string $title): void
        {
            $this->title = $title;
        }
    }
