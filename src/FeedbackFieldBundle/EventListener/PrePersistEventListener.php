<?php

namespace FeedbackFieldBundle\EventListener;

use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\Feedback;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\ORM\Event\LifecycleEventArgs;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class PrePersistEventListener  {



    const MIN_LENGTH = 10;
    const MIN_LENGTH_BIG = 100;
    const MAX_LENGTH = 250;
    const LENGTH_STEP = 1;

    function PrePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Feedback) {
            if (!$entity->getPublicId()) {
                $manager = $args->getEntityManager()->getRepository('FeedbackFieldBundle:Feedback');
                $idLen = self::MIN_LENGTH_BIG;
                $id = \FeedbackFieldBundle\FeedbackFieldBundle::createKey(1, $idLen);
                while ($manager->doesPublicIdExist($id, $entity->getProject())) {
                    if ($idLen < self::MAX_LENGTH) {
                        $idLen = $idLen + self::LENGTH_STEP;
                    }
                    $id = \FeedbackFieldBundle\FeedbackFieldBundle::createKey(1, $idLen);
                }
                $entity->setPublicId($id);
            }
        } else if ($entity instanceof Export) {
            if (!$entity->getPublicId()) {
                $manager = $args->getEntityManager()->getRepository('FeedbackFieldBundle:Export');
                $idLen = self::MIN_LENGTH;
                $id =  \FeedbackFieldBundle\FeedbackFieldBundle::createKey(1,$idLen);
                while($manager->doesPublicIdExist($id, $entity->getProject())) {
                    if ($idLen < self::MAX_LENGTH) {
                        $idLen = $idLen + self::LENGTH_STEP;
                    }
                    $id =  \FeedbackFieldBundle\FeedbackFieldBundle::createKey(1,$idLen);
                }
                $entity->setPublicId($id);
            }
        }

    }

}
