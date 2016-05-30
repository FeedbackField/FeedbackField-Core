<?php

namespace FeedbackFieldBundle;

use FeedbackFieldBundle\DependencyInjection\FeedbackFieldExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldBundle extends Bundle
{


    static function createKey($minLength = 10, $maxLength = 100)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      $string ='';
      $length = mt_rand($minLength, $maxLength);
      for ($p = 0; $p < $length; $p++)
      {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
      }
      return $string;
    }


    public function getContainerExtension()
    {
        return new FeedbackFieldExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FeedbackFieldTypeFinderCompilerPass());
    }

}
