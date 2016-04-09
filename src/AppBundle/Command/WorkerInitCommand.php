<?php

namespace AppBundle\Command;

use AppBundle\Entity\Message;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManager;

class WorkerInitCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('worker-init')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $url = 'https://api.github.com/repos/symfony/symfony/commits';

        $client = new Client();
        $res = $client->request('GET', $url);


        if($res->getStatusCode()==200){

            $body = $res->getBody();
            $body=json_decode($body);


            foreach($body as $item){

                $date = new \DateTime($item->commit->author->date);

                $messageModel = new Message();
                $messageModel->setHash($item->sha);
                $messageModel->setAuthor($item->commit->author->name);
                $messageModel->setDate($date);
                $messageModel->setEmail($item->commit->author->email);
                $messageModel->setMessage($item->commit->message);

                $em->persist($messageModel);
                $em->flush();



            }
        }


        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }

        $output->writeln('Command result.');
    }

}
