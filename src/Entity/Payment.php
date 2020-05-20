<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="payments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_kind;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_info;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_of_payment;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPaymentKind(): ?string
    {
        return $this->payment_kind;
    }

    public function setPaymentKind(string $payment_kind): self
    {
        $this->payment_kind = $payment_kind;

        return $this;
    }

    public function getBillingInfo(): ?string
    {
        return $this->billing_info;
    }

    public function setBillingInfo(string $billing_info): self
    {
        $this->billing_info = $billing_info;

        return $this;
    }

    public function getDateOfPayment(): ?\DateTimeInterface
    {
        return $this->date_of_payment;
    }

    public function setDateOfPayment(\DateTimeInterface $date_of_payment): self
    {
        $this->date_of_payment = $date_of_payment;

        return $this;
    }
}
