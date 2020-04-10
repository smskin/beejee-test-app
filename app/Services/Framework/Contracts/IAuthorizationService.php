<?php


namespace App\Services\Framework\Contracts;


use App\DBContext\DBContextUser;
use App\Services\Framework\Services\View\Exceptions\ValidationException;

interface IAuthorizationService
{
    /**
     * @param string $userName
     * @param string $password
     * @throws ValidationException
     */
    public function attempt(string $userName, string $password): void;
    public function loginByUser(DBContextUser $user): void;
    public function check(): bool;
    public function getUser(): ?DBContextUser;
}