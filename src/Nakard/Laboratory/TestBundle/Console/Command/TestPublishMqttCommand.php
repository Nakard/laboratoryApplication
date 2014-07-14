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
use Nakard\Laboratory\TestBundle\Entity\Tests\Test;

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
        $index = 0;
        while ($mqtt->loop() == 0) {
            $output->writeln($index);
            if (100 <= ++$index) {
                $tests = $repository->findUnconducted();
                $output->writeln('Tests refreshed');
                $index = 0;
            }
            if (empty($tests)) {
                continue;
            }
            /** @var Test $randTest */
            $randTest = $tests[array_rand($tests)];
            $testId = $randTest->getId();
            $randValue = rand(0, 10000) / 100;
            $message = $randValue;
            $mqtt->publish('test/' . $testId . '/value', $message, 1, false);
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
