<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game_events")
 */
class GameEvent
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="game_events_seq", initialValue=1, allocationSize=1)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", nullable=false)
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    private $team;

    /**
     * @ORM\Column(type="integer", name="player_id", nullable=true)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $period;

    /**
     * @ORM\Column(type="string")
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     *
     * @ORM\Column(type="json_document", options={"jsonb": true})
     */
    private $data;

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

    public function setGame(Game $game)
    {
        $this->game = $game;

        return $this;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    public function getPlayer()
    {
        return $this->player;
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

    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
