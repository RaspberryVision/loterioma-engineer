<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_NOT_AVAILABLE = 2;

    /**
     * Default webservices works on port 80.
     */
    public const PORT_DEFAULT = 80;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $host;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $port;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ServiceStatus::class, mappedBy="service", cascade={"PERSIST"})
     */
    private $statuses;

    /**
     * Service constructor.
     * @param string $name
     * @param string $host
     * @param string|null $port
     * @param string|null $description
     */
    public function __construct(
        string $name,
        string $host,
        ?string $port = self::PORT_DEFAULT,
        ?string $description = null
    ) {
        $this->name = $name;
        $this->host = $host;
        $this->port = $port;
        $this->description = $description;
        $this->statuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getPort(): ?string
    {
        return $this->port;
    }

    public function setPort(?string $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ServiceStatus[]
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(ServiceStatus $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses[] = $status;
            $status->setService($this);
        }

        return $this;
    }

    public function removeStatus(ServiceStatus $status): self
    {
        if ($this->statuses->contains($status)) {
            $this->statuses->removeElement($status);
            // set the owning side to null (unless already changed)
            if ($status->getService() === $this) {
                $status->setService(null);
            }
        }

        return $this;
    }

    /**
     * Get last (current) service status.
     *
     * @return ServiceStatus|null
     */
    public function getCurrentStatus()
    {
        return $this->statuses->last();
    }
}
