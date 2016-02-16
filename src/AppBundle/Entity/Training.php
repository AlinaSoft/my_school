<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="training")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainingRepository")
 */
class Training
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
     * @var string
     *
     * @ORM\Column(name="training_name", type="string", length=255)
     */
    private $trainingName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="training_date", type="datetime")
     */
    private $trainingDate;

    /**
     * @var int
     *
     * @ORM\Column(name="training_user_count", type="integer")
     */
    private $trainingUserCount;

    /**
     * ORM\@ManyToMany(targetEntity="User")
     * ORM\@JoinTable(name="user_training",
     *       joinColumns={@JoinColumn(name="training_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    private $users;
    /**
     * @var int
     * ORM\@OneToMany(targetEntity="UserTraining")
     * ORM\@JoinTable(name="user_training",
     *       joinColumns={@JoinColumn(name="training_id", referencedColumnName="id")}
     *      )
     */
    private $usersCount;

    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usersCount = 0;
    }

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
     * Set trainingName
     *
     * @param string $trainingName
     *
     * @return Training
     */
    public function setTrainingName($trainingName)
    {
        $this->trainingName = $trainingName;

        return $this;
    }

    /**
     * Get trainingName
     *
     * @return string
     */
    public function getTrainingName()
    {
        return $this->trainingName;
    }

    /**
     * Set trainingDate
     *
     * @param \DateTime $trainingDate
     *
     * @return Training
     */
    public function setTrainingDate($trainingDate)
    {
        $this->trainingDate = $trainingDate;

        return $this;
    }

    /**
     * Get trainingDate
     *
     * @return \DateTime
     */
    public function getTrainingDate()
    {
        return $this->trainingDate;
    }

    /**
     * Set trainingUserCount
     *
     * @param integer $trainingUserCount
     *
     * @return Training
     */
    public function setTrainingUserCount($trainingUserCount)
    {
        $this->trainingUserCount = $trainingUserCount;

        return $this;
    }

    /**
     * Get trainingUserCount
     *
     * @return int
     */
    public function getTrainingUserCount()
    {
        return $this->trainingUserCount;
    }
}

