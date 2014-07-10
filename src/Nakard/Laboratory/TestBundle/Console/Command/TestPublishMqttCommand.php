<?php
/**
 * TestPublishMqttCommand.php
 *
 * Creation date: 2014-07-10
 * Creation time: 22:53
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Console\Command;

use Mosquitto\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Nakard\Laboratory\TestBundle\Entity\Tests\TestRepository;

/**
 * Class TestPublishMqttCommand
 *
 * @package Nakard\Laboratory\TestBundle\Console\Command
 */
class TestPublishMqttCommand extends Command implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function configure()
    {
        $this
            ->setName('test:publish');
    }

    /**
     * @inheritdoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var TestRepository $repository */
        $repository = $this->container->get('doctrine')->getRepository('NakardLaboratoryTestBundle:Tests\Test');
        $tests = $repository->findUnconducted();
        $mqtt = new Client();
        $mqtt->connect('localhost');
        while ($mqtt->loop() == 0) {
            $randTest = $tests[array_rand($tests)];
            $id = $randTest->getId();
            $randValue = rand(0, 10000) / 100;
            $message = $randValue;
            $mqtt->publish('test/' . $id . '/value', $message, 1, false);
            $mqtt->loop();
            sleep(1);
        }
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
