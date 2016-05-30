<?php

namespace FeedbackFieldBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\Project;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldDefinitionRepository extends EntityRepository
{

    public function getForProject(Project $project) {
        return $this->findBy( array('project' => $project) , array('sort'=>'ASC') );
    }


    public function getNextSortOrderForNewFieldOnProject(Project $project) {
        $s =  $this->getEntityManager()
            ->createQuery(
                ' SELECT MAX(pfd.sort) AS sort FROM FeedbackFieldBundle:FeedbackFieldDefinition pfd '.
                ' WHERE pfd.project = :project '.
                ' GROUP BY pfd.project'
            )
            ->setParameter('project', $project)
            ->getResult();
        return $s ? $s[0]['sort'] + 10 : 10;
    }

}
