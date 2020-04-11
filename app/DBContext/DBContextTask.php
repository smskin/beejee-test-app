<?php

namespace App\DBContext;

use App\Services\Framework\Services\Database\Models\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DBContextTask
 * @package App\DBContext
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity
 */
class DBContextTask extends Model
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
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    protected $text;

    /**
     * @var int
     *
     * @ORM\Column(name="is_closed", type="smallint", nullable=false, options={"default" : 0})
     */
    protected $is_closed;

    /**
     * @var int
     *
     * @ORM\Column(name="is_edited_by_admin", type="smallint", nullable=false, options={"default" : 0})
     */
    protected $is_edited_by_admin;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function setUserName(string $userName): DBContextTask
    {
        $this->username = $userName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): DBContextTask
    {
        $this->email = $email;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): DBContextTask
    {
        $this->text = $text;
        return $this;
    }

    public function isClosed(): bool
    {
        return boolval($this->is_closed);
    }

    public function setClosedStatus(bool $state): DBContextTask
    {
        $this->is_closed = ($state === true) ? 1 : 0;
        return $this;
    }

    public function isEditedByAdmin(): bool
    {
        return boolval($this->is_edited_by_admin);
    }

    public function setEditedByAdminStatus(bool $state): DBContextTask
    {
        $this->is_edited_by_admin = ($state === true) ? 1 : 0;
        return $this;
    }
}