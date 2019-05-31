<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuotationRepository")
 */
class Quotation
{
    // Value to packageType
    const BASEPACK = 1;
    const EMARKETING = 2;
    const DESIGN = 3;
    const DEVELOPMENT = 4;

    // Value to status
    const TOANSWER = 0;
    const ANSWERED = 1;
    const CONCLUDED = 2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="array")
     */
    private $packageType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $answeredAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $concludedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=16000, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10000,
     *      minMessage = "Votre commentaire {{ limit }} doit être plus long",
     *      maxMessage = "Votre commentaire {{ limit }} est trop long"
     * )
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quotations")
     * @ORM\JoinColumn(name="user_id", nullable=true, referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     */
    private $Email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPackageType(): ?array
    {
        return $this->packageType;
    }

    public function setPackageType(?array $packageType): self
    {
        $this->packageType = $packageType;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAnsweredAt(): ?\DateTimeInterface
    {
        return $this->answeredAt;
    }

    public function setAnsweredAt(?\DateTimeInterface $answeredAt): self
    {
        $this->answeredAt = $answeredAt;

        return $this;
    }

    public function getConcludedAt(): ?\DateTimeInterface
    {
        return $this->concludedAt;
    }

    public function setConcludedAt(?\DateTimeInterface $concludedAt): self
    {
        $this->concludedAt = $concludedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }
}
