<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="games")
 */
class Game
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="games_seq", initialValue=1, allocationSize=1)
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id", nullable=false)
     */
    private $homeTeam;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="visitor_team_id", referencedColumnName="id", nullable=false)
     */
    private $visitorTeam;

    /**
     * @ORM\Column(type="integer")
     */
    private $period;

    /**
     * @ORM\Column(type="string")
     */
    private $time;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastStartAt;

    /**
     *
     * @ORM\Column(type="json_document", options={"jsonb": true}, nullable=true)
     */
    private $scores;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setHomeTeam(Team $team)
    {
        $this->homeTeam = $team;

        return $this;
    }

    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    public function setVisitorTeam(Team $team)
    {
        $this->visitorTeam = $team;

        return $this;
    }

    public function getVisitorTeam()
    {
        return $this->visitorTeam;
    }

    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setLastStartAt($date)
    {
        $this->lastStartAt = $date;
        
        return $this;
    }

    public function getLastStartAt()
    {
        return $this->lastStartAt;
    }

    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    public function getScores()
    {
        return $this->scores;
    }

    public function setCreatedAt($date)
    {
        $this->createdAt = $date;
        
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
