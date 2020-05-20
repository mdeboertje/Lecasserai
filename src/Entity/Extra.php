<?php

namespace App\Entity;

use App\Repository\ExtrasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExtrasRepository::class)
 */
class Extra
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $additional_cost;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="extra")
     */
    private $room_id;

    public function __construct()
    {
        $this->room_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdditionalCost(): ?float
    {
        return $this->additional_cost;
    }

    public function setAdditionalCost(float $additional_cost): self
    {
        $this->additional_cost = $additional_cost;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoomId(): Collection
    {
        return $this->room_id;
    }

    public function addRoomId(Room $roomId): self
    {
        if (!$this->room_id->contains($roomId)) {
            $this->room_id[] = $roomId;
            $roomId->setExtra($this);
        }

        return $this;
    }

    public function removeRoomId(Room $roomId): self
    {
        if ($this->room_id->contains($roomId)) {
            $this->room_id->removeElement($roomId);
            // set the owning side to null (unless already changed)
            if ($roomId->getExtra() === $this) {
                $roomId->setExtra(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->description;
    }

}
