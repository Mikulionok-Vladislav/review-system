<?php

namespace App\Kernel\Controller;
use APP\Kernel\View\ViewInterface;
use APP\Kernel\Http\RequestInterface;
use APP\Kernel\Http\RedirectInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Storage\StorageInterface;

abstract class Controller
{
private ViewInterface $view;
private RequestInterface $request;
private RedirectInterface $redirect;
private SessionInterface $session;
private DatabaseInterface $database;
    private AuthInterface $auth;
    private StorageInterface $storage;


    public function view(string $name, array $data = [], string $title = ''): void
    {
        $this->view->page($name, $data, $title);
    }

    /**
     * @param ViewInterface $view
     */
    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    /**
     * @return RequestInterface
     */
    public function request(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    /**
     * @param RedirectInterface $redirect
     */
    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url):void{
        $this->redirect->to($url);
    }

    /**
     * @return SessionInterface
     */
    public function session(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    /**
     * @return DatabaseInterface
     */
    public function db(): DatabaseInterface
    {
        return $this->database;
    }

    /**
     * @param DatabaseInterface $database
     */
    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    /**
     * @return AuthInterface
     */
    public function auth(): AuthInterface
    {
        return $this->auth;
    }

    /**
     * @param AuthInterface $auth
     */
    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return StorageInterface
     */
    public function storage(): StorageInterface
    {
        return $this->storage;
    }

    /**
     * @param StorageInterface $storage
     */
    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }
}