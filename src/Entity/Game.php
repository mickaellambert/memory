<?php

namespace Memory\Entity;

// Permet d'utliser les annotations Doctrine
use Doctrine\ORM\Mapping as ORM;

// Permet de séraliser notre objet afin de le retourner en JSON si on le veut
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="games")
 */
class Game implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $time;

    /**
     * @ORM\Column(type="string")
     */
    protected $player;

    /**
     * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @ORM\GeneratedValue
     */
    protected $createdAt;

    public function __construct() {
        $this->setCreatedAt(new \DateTime('now'));
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayer($player)
    {
        $this->player = $player;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function __toString()
    {
        $format = "Game (id: %s, player: %s, time: %s, created_at: %s)\n";
        return sprintf($format, $this->id, $this->player, $this->time, $this->createdAt->format('Y-m-d H:i:s'));
    }

    public function jsonSerialize()
    {
        return [
            'player' => $this->player,
            'time'   => $this->time,
        ];
    }
}