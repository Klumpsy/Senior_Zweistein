<?php

namespace App\Entity;

use App\Repository\AddBlogRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddBlogRepository::class)]
class AddBlog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 5)]
    private $title;

    #[ORM\Column(type: 'string', length: 1000)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 10)]
    private $blogData;

    #[ORM\Column(type: 'string', length: 30)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    private $author;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBlogData(): ?string
    {
        return $this->blogData;
    }

    public function setBlogData(string $blogData): self
    {
        $this->blogData = $blogData;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
