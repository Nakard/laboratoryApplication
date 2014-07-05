<?php

namespace Nakard\Laboratory\UserBundle;

use Nakard\Laboratory\UserBundle\DependencyInjection\Compiler\ValidatorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NakardLaboratoryUserBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ValidatorPass());
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
