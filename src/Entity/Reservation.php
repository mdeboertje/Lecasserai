<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkin_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkout_date;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, cascade={"persist", "remove"})
     */
    private $payment_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_method;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?Room
    {
        return $this->room_id;
    }

    public function setRoomId(?Room $room_id): self
    {
        $this->room_id = $room_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCheckinDate(): ?\DateTimeInterface
    {
        return $this->checkin_date;
    }

    public function setCheckinDate(\DateTimeInterface $checkin_date): self
    {
        $this->checkin_date = $checkin_date;

        return $this;
    }

    public function getCheckoutDate(): ?\DateTimeInterface
    {
        return $this->checkout_date;
    }

    public function setCheckoutDate(\DateTimeInterface $checkout_date): self
    {
        $this->checkout_date = $checkout_date;

        return $this;
    }

    public function getPaymentId(): ?payment
    {
        return $this->payment_id;
    }

    public function setPaymentId(?payment $payment_id): self
    {
        $this->payment_id = $payment_id;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }
}
