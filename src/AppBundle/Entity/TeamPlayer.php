<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="team_players")
 */
class TeamPlayer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="team_players_seq", initialValue=1, allocationSize=1)
     */
    private $id;

    /**
     * Many team players has one team
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="teamPlayers")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id", nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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

    public function setTeam($team)
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

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }
    public function getNumber()
    {
        return $this->number;
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
