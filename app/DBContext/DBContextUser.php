<?php

namespace App\DBContext;

use App\Services\Framework\Services\Database\Models\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DBContextUser
 * @package App\DBContext
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class DBContextUser extends Model
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    protected $username;

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

    public function getUserName(): string
    {
        return $this->username;
    }

    /**
     * @param string $userName
     * @return DBContextUser
     */
    public function setUserName(string $userName): DBContextUser
    {
        $this->username = $userName;
        return $this;
    }

    public function setPassword(string $password): DBContextUser
    {
        $this->password = sha1($password);
        return $this;
    }

    public function comparePasswords(string $password): bool
    {
        return (sha1($password) === $this->password) ? true : false;
    }
}