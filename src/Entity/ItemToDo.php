<?php

namespace App\Entity;

use App\Repository\ItemToDoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemToDoRepository::class)]
class ItemToDo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $done = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ListToDo $listToDo = null;

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

    public function isDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getListToDo(): ?ListToDo
    {
        return $this->listToDo;
    }

    public function setListToDo(?ListToDo $listToDo): self
    {
        $this->listToDo = $listToDo;

        return $this;
    }
}
