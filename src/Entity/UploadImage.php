<?php

namespace App\Entity;

use App\Repository\UploadImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UploadImageRepository::class)]
class UploadImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $UploadedImage = null;

    #[ORM\ManyToOne(inversedBy: 'uploadimages')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUploadedImage()
    {
        return $this->UploadedImage;
    }

    public function setUploadedImage($UploadedImage)
    {
        $this->UploadedImage = $UploadedImage;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
