<?php

namespace LaravelEnso\ImapAuth;

use Ddeboer\Imap\Exception\AuthenticationFailedException;
use Ddeboer\Imap\Server;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class ImapUserProvider implements UserProvider
{
    protected $model;
    private $config;

    public function __construct($model, $config)
    {
        $this->model = $model;
        $this->config = $config;
    }

    public function retrieveById($id)
    {
        return $this->model::find($id);
    }

    public function retrieveByToken($user, $token)
    {
        //
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        //
    }

    public function retrieveByCredentials(array $credentials)
    {
        if ($credentials !== null) {
            return $this->model::whereEmail($credentials['email'])->first();
        }
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $server = new Server($this->config['server'], $this->config['port'], $this->config['parameters']);

        try {
            $email = $credentials['email'];
            $server->authenticate($email, $credentials['password']);
        } catch (AuthenticationFailedException $e) {
            return false;
        }

        return true;
    }
}
