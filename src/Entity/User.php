<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quotation", mappedBy="user")
     */
    private $quotations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Business", inversedBy="users")
     */
    private $business;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Independent", mappedBy="user", cascade={"persist", "remove"})
     */
    private $independent;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->quotations = new ArrayCollection();
    }

    /**
     * @return Collection|Quotation[]
     */
    public function getQuotations(): Collection
    {
        return $this->quotations;
    }

    public function addQuotation(Quotation $quotation): self
    {
        if (!$this->quotations->contains($quotation)) {
            $this->quotations[] = $quotation;
            $quotation->setUser($this);
        }

        return $this;
    }

    public function removeQuotation(Quotation $quotation): self
    {
        if ($this->quotations->contains($quotation)) {
            $this->quotations->removeElement($quotation);
            // set the owning side to null (unless already changed)
            if ($quotation->getUser() === $this) {
                $quotation->setUser(null);
            }
        }

        return $this;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function setBusiness(?Business $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getIndependent(): ?Independent
    {
        return $this->independent;
    }

    public function setIndependent(?Independent $independent): self
    {
        $this->independent = $independent;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $independent === null ? null : $this;
        if ($newUser !== $independent->getUser()) {
            $independent->setUser($newUser);
        }

        return $this;
    }
}