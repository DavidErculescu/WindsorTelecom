<?php
    namespace App\Entity;
    
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Client
     *
     * @ORM\Table(name="clients")
     * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
     */
    class ClientEntity
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
         * @ORM\Column(name="first_name", type="text")
         */
        private $firstName;

        /**
         * @var string
         *
         * @ORM\Column(name="last_name", type="text")
         */
        private $lastName;

        /**
         * @var string
         *
         * @ORM\Column(name="email", type="string")
         */
        private $email;

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
        public function getFirstName(): string
        {
            return $this->firstName;
        }

        /**
         * @param string $firstName
         */
        public function setFirstName(string $firstName): void
        {
            $this->firstName = $firstName;
        }

        /**
         * @return string
         */
        public function getLastName(): string
        {
            return $this->lastName;
        }

        /**
         * @param string $lastName
         */
        public function setLastName(string $lastName): void
        {
            $this->lastName = $lastName;
        }

        /**
         * @return string
         */
        public function getEmail(): string
        {
            return $this->email;
        }

        /**
         * @param string $email
         */
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }
    }
