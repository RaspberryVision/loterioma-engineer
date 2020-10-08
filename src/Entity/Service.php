<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
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
}
