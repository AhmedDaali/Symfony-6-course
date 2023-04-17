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

use App\Repository\MicropostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MicropostRepository::class)]
class Micropost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;



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
}
