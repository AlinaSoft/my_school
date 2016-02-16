<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTraining
 *
 * @ORM\Table(name="user_training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTrainingRepository")
 */
class UserTraining
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="training_id", type="integer")
     *
     * @ORM\ManyToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $trainingId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserTraining
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set trainingId
     *
     * @param integer $trainingId
     *
     * @return UserTraining
     */
    public function setTrainingId($trainingId)
    {
        $this->trainingId = $trainingId;

        return $this;
    }

    /**
     * Get trainingId
     *
     * @return int
     */
    public function getTrainingId()
    {
        return $this->trainingId;
    }
}

