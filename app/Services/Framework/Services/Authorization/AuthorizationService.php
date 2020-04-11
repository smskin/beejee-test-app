<?php


namespace App\Services\Framework\Services\Authorization;

use App\DBContext\DBContextUser;
use App\Services\Framework\Contracts\IAuthorizationService;
use App\Services\Framework\Services\View\Exceptions\ValidationException;
use Josantonius\Session\Session;

class AuthorizationService implements IAuthorizationService
{
    protected const AUTH_SESSION_KEY = 'user_id';

    /**
     * @var DBContextUser|null
     */
    public $user;

    public function __construct()
    {
        $this->authBySession();
    }

    /**
     * @param string $userName
     * @param string $password
     * @throws ValidationException
     */
    public function attempt(string $userName, string $password): void
    {
        $user = $this->getUserByUserName($userName);
        if (!$user){
            ValidationException::withMessages([
                'userName'=>[
                    'User not exists'
                ]
            ]);
        }

        if (!$user->comparePasswords($password)){
            ValidationException::withMessages([
                'password'=>[
                    'Password not correct'
                ]
            ]);
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

    public function logout(): void
    {
        Session::destroy(self::AUTH_SESSION_KEY);
        $this->user = null;
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
}