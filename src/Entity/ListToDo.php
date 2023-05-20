<?php

namespace App\Entity;

use App\Repository\ListToDoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListToDoRepository::class)]
class ListToDo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'lists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\OneToMany(mappedBy: 'listToDo', targetEntity: ItemToDo::class, orphanRemoval: true)]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection<int, ItemToDo>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ItemToDo $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setListToDo($this);
        }

        return $this;
    }

    public function removeItem(ItemToDo $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getListToDo() === $this) {
                $item->setListToDo(null);
            }
        }

        return $this;
    }
}
