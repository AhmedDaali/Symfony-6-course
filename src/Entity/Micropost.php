<?php
/*@ORM\Entity(repositoryClass=MicropostRepository::class) indica que esta clase es una entidad mapeada a la base de datos, y especifica la clase que se encargará de manejar las operaciones de persistencia (MicropostRepository en este caso).
@ORM\Id indica que el siguiente atributo es la clave primaria de la entidad.
@ORM\GeneratedValue especifica que el valor del siguiente atributo será generado automáticamente por el sistema de base de datos al insertar una nueva fila en la tabla.
@ORM\Column indica que el siguiente atributo es una columna en la tabla de base de datos, y especifica el tipo de columna y cualquier otra opción relevante (longitud, etc.).
private ?int $id = null; define el atributo id como un entero opcional (puede ser nulo) y lo inicializa en nulo.
public function getId(): ?int define el método getId() que devuelve el valor de id. El ? antes del int indica que el valor de retorno también puede ser nulo.
public function setTitle(string $title): self define el método setTitle() que establece el valor de title. El self al final indica que el método devuelve una referencia a la instancia actual de la clase, lo que permite encadenar métodos.
public function getCreated(): ?\DateTimeInterface define el método getCreated() que devuelve el valor de created. \DateTimeInterface es una interfaz que define los métodos comunes a todas las clases de fecha y hora de PHP.
public function setCreated(\DateTimeInterface $created): self define el método setCreated() que establece el valor de created. La clase Micropost espera una instancia de una clase que implemente la interfaz \DateTimeInterface como argumento*/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\MicropostRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MicropostRepository::class)]
class Micropost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 255, minMessage: 'Title is to short, 5 characters is the minimum.')]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 500)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true, cascade: ['persist'])]
    private $comments;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'liked')]
    private $likedBy;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
    }



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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
        /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
        /**
     * @return Collection<int, User>
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    public function addLikedBy(User $likedBy): self
    {
        if (!$this->likedBy->contains($likedBy)) {
            $this->likedBy[] = $likedBy;
        }

        return $this;
    }

    public function removeLikedBy(User $likedBy): self
    {
        $this->likedBy->removeElement($likedBy);

        return $this;
    }
}
