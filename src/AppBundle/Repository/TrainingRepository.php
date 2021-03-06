<?php

namespace AppBundle\Repository;

/**
 * TrainingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrainingRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByTime()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p, count(ut.trainingId) as trainingUsers FROM AppBundle:Training p left join AppBundle:UserTraining ut with p.id = ut.trainingId GROUP BY p.id ORDER BY p.trainingDate ASC'
            )
            ->getResult();
    }
    public function findById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Training p Where p.id= '.$id
            )
            ->getResult();
    }
}
