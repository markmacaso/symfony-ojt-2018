<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="teams")
 */
class Team
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="teams_seq", initialValue=1, allocationSize=1)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *     min = 1,
     *     max = 100,
     * )
     */
    private $name;

    /**
     * One Team has many TeamPlayers
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeamPlayer", mappedBy="team")
     */
    private $teamPlayers;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    public function __construct()
    {
        $this->setTeamPlayers(new ArrayCollection());
        $this->setCreatedAt(new \DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTeamPlayers($players)
    {
        $this->teamPlayers = $players;

        return $this;
    }

    public function getTeamPlayers()
    {
        return $this->teamPlayers;
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
