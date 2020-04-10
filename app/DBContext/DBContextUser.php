<?php

namespace App\DBContext;

use App\Services\Framework\Contracts\IModel;
use App\Services\Framework\Services\Database\Models\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DBContextUser
 * @package App\DBContext
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class DBContextUser extends Model implements IModel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DBContextUser
     */
    public function setName(string $name): DBContextUser
    {
        $this->name = $name;
        return $this;
    }

    public function setPassword(string $password): DBContextUser
    {
        $this->password = $password;
        return $this;
    }
}