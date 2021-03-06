<?php

namespace FeedbackFieldTypeStringBundle\Repository;


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
class FeedbackFieldValueStringRepository extends EntityRepository
{

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition) {
        $result = $this->getEntityManager()
            ->createQuery(
                ' SELECT count(f) AS c FROM FeedbackFieldTypeStringBundle:FeedbackFieldValueString fv'.
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


    public function getEnum(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition) {
        $results = $this->getEntityManager()
            ->createQuery(
                ' SELECT fv.value, count(f) AS c FROM FeedbackFieldTypeStringBundle:FeedbackFieldValueString fv'.
                ' JOIN fv.feedback f ' .
                ' WHERE f.project = :project AND f.createdAt >= :from AND f.createdAt <= :to AND fv.feedbackFieldDefinition = :fieldDef '.
                ' GROUP BY fv.value '
            )
            ->setParameter('project', $project)
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->setParameter('fieldDef', $feedbackFieldDefinition)
            ->getResult();
        $out = array();
        foreach($results as $result) {
            $out[$result['value']] = array('total'=>$result['c']);
        }
        return $out;
    }


}

