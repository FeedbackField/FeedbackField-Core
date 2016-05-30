<?php

namespace FeedbackFieldTypeTextBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\DateRange;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueTextRepository extends EntityRepository
{

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition) {
        $result = $this->getEntityManager()
            ->createQuery(
                ' SELECT count(f) AS c FROM FeedbackFieldTypeTextBundle:FeedbackFieldValueText fv'.
                ' JOIN fv.feedback f ' .
                ' WHERE f.project = :project AND f.createdAt >= :from AND f.createdAt <= :to AND fv.feedbackFieldDefinition = :fieldDef '.
                ' ORDER BY f.createdAt ASC '
            )
            ->setParameter('project', $project)
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->setParameter('fieldDef', $feedbackFieldDefinition)
            ->getScalarResult();
        return $result[0]['c'];
    }

}

