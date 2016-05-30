<?php

namespace FeedbackFieldBundle\Repository;


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
class FeedbackRepository extends EntityRepository
{

    public function getList(Project $project, DateRange $dateRange) {
        return $this->getEntityManager()
            ->createQuery(
                ' SELECT f FROM FeedbackFieldBundle:Feedback f'.
                ' WHERE f.project = :project AND f.createdAt >= :from AND f.createdAt <= :to '.
                ' ORDER BY f.createdAt ASC '
            )
            ->setParameter('project', $project)
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->getResult();
    }


    public function getCount(Project $project, DateRange $dateRange) {
        $result = $this->getEntityManager()
            ->createQuery(
                ' SELECT count(f) AS c FROM FeedbackFieldBundle:Feedback f'.
                ' WHERE f.project = :project AND f.createdAt >= :from AND f.createdAt <= :to '.
                ' ORDER BY f.createdAt ASC '
            )
            ->setParameter('project', $project)
            ->setParameter('from', $dateRange->getFrom())
            ->setParameter('to', $dateRange->getTo())
            ->getScalarResult();
        return $result[0]['c'];
    }

    public function doesPublicIdExist($id, Project $project)
    {
        if ($project->getId()) {
            $s =  $this->getEntityManager()
                ->createQuery(
                    ' SELECT f FROM FeedbackFieldBundle:Feedback f'.
                    ' WHERE f.project = :project AND f.publicId = :public_id'
                )
                ->setParameter('project', $project)
                ->setParameter('public_id', $id)
                ->getResult();
            return (boolean)$s;
        } else {
            return false;
        }
    }


}
