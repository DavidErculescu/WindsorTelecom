<?php
    namespace App\Services;
    
    use App\Entity\ActionEntity;
    use App\Entity\OrderEntity;
    use Symfony\Component\DependencyInjection\ContainerInterface;
    use Symfony\Component\Mailer\MailerInterface;
    use Symfony\Component\Mime\Email;
    use Twig\Environment;

    class ActionService
    {
        protected   $container;
        protected   $em;
        protected   $twig;

        public function __construct(ContainerInterface $container, Environment $twig)
        {
            $this->container = $container;
            $this->em = $this->container->get('doctrine')->getManager();

            $this->twig = $twig;
        }

        public function saveFile($orderId)
        {
            //Save file by the order id

            return 'https://symfony.com/doc/current/controller/upload_file.html';
        }

        public function sendEmail($actionDetails, $orderId)
        {
            $email = new Email();

            $order = $this->em->getRepository(OrderEntity::class)->findOneById($orderId);

            $email->from('sender@windsor-telecom.co.uk');

            if ($actionDetails['recipient'] == 'client')
            {
                $email->to($order->getClient()->getEmail());
            }
            elseif ($actionDetails['recipient'] == 'sales')
            {
                $email->to("sales@windosr-telecom.co.uk");
            }

            $email->subject($actionDetails['subject']);

            $html = $this->twig->render('email/'.$actionDetails['template'].'.html.twig');

            $email->html($html);

            //Configure mailer to send the email

            return 'email_sent';
        }

        public function executeCurrentAction($orderId)
        {
            $actionId = $this->em->getRepository(OrderEntity::class)->getCurrentStageAction($orderId);
            $action = $this->em->getRepository(ActionEntity::class)->findOneById($actionId);

            if ($action)
            {
                $actionDetails = $action->getAction();

                switch ($actionDetails['type'])
                {
                    case 'email':
                        $result = $this->sendEmail($actionDetails, $orderId);
                    break;

                    case 'save':
                        $result = $this->saveFile($orderId);
                    break;

                    default:
                    break;
                }
            }
            else
            {
                $result = [
                    'error' => 'invalid_action',
                    'error_description' => 'There is no action set.'
                ];
            }

            return $result;
        }
    }