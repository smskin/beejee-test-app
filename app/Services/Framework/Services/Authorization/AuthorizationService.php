<?php


namespace App\Services\Framework\Services\Authorization;

use App\DBContext\DBContextUser;
use App\Services\Framework\Contracts\IAuthorizationService;
use App\Services\Framework\Services\Authorization\Exceptions\AttemptException;
use Josantonius\Session\Session;

class AuthorizationService implements IAuthorizationService
{
    protected const AUTH_SESSION_KEY = 'user_id';

    /**
     * @var DBContextUser
     */
    public $user;

    public function __construct()
    {
        $this->authBySession();
        $this->initHelpers();
    }

    /**
     * @param string $userName
     * @param string $password
     * @throws AttemptException
     */
    public function attempt(string $userName, string $password): void
    {
        $user = $this->getUserByUserName($userName);
        if (!$user){
            throw new AttemptException('User not exists');
        }

        if (!$user->comparePasswords($password)){
            throw new AttemptException('Password not correct');
        }

        $this->loginByUser($user);
    }

    private function authBySession(): void
    {
        $userId = Session::get(self::AUTH_SESSION_KEY);
        if (!$userId){
            return;
        }

        $user = DBContextUser::find($userId);
        if (!$user){
            Session::destroy(self::AUTH_SESSION_KEY);
        }
        /** @noinspection PhpParamsInspection */
        $this->loginByUser($user);
    }

    public function loginByUser(DBContextUser $user): void
    {
        Session::set(self::AUTH_SESSION_KEY, $user->getId());
        $this->user = $user;
    }

    public function check(): bool
    {
        return ($this->user instanceof DBContextUser) ? true : false;
    }

    public function getUser(): ?DBContextUser
    {
        return $this->user;
    }

    private function getUserByUserName(string $userName): ?DBContextUser
    {
        $query = DBContextUser::builder()
            ->where('t.username = :username')
            ->setParameter('username', $userName)
            ->getQuery()
            ->getResult();
        if (!count($query)){
            return null;
        }
        return $query[0];
    }

    private function initHelpers()
    {
        require_once 'Helpers/functions.php';
    }
}