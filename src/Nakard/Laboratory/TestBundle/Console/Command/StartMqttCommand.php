<?php
/**
 * StartMqttCommand.php
 *
 * Creation date: 2014-07-10
 * Creation time: 22:44
 *
 * @author Arkadiusz Moskwa <a.moskwa@gmail.com>
 */

namespace Nakard\Laboratory\TestBundle\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Mosquitto\Message;
use Predis\Client;

/**
 * Class StartMqttCommand
 *
 * @package Nakard\Laboratory\TestBundle\Console\Command
 */
class StartMqttCommand extends Command implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function configure()
    {
        $this
            ->setName('test:start:mqtt');
    }

    /**
     * @inheritdoc
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Client $redis */
        $redis = $this->container->get('nakard_laboratory_test.redis');
        $mqtt = $this->container->get('nakard_laboratory_test.mosquitto.subscriber');
        $mqtt->onMessage(function (Message $message) use($redis, $output) {
            preg_match('/\d+/', $message->topic, $matches);
            $id = $matches[0];
            $key = 'test:' . $id;
            $output->writeln($message->topic . ': ' . $message->payload . ', id: ' . $id);
            $redis->hset($key, 'value', $message->payload);
            $redis->hset($key, 'timestamp', time());
        });
        $mqtt->subscribe('#', 1);
        $mqtt->loopForever();
    }

    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}
