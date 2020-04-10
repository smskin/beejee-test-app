<?php

namespace App\Services\Framework\Services\View;

use App\Services\Framework\Contracts\IViewService;
use Smarty;
use SmartyException;

class ViewService implements IViewService
{
    /**
     * @var Smarty
     */
    protected $smarty;

    public function boot(): void
    {
        $this->initHelpers();
        $this->initSmarty();
    }

    private function initSmarty(): void
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
        $smarty->setCompileDir(base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'compile'.DIRECTORY_SEPARATOR);
        $smarty->setCacheDir(base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);
        $smarty->setCaching(true);
        $this->smarty = $smarty;
    }

    private function initHelpers(): void
    {
        require_once 'Helpers/functions.php';
    }

    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @throws SmartyException
     */
    public function render(string $template, array $variables = []): void
    {
        foreach ($variables as $variable => $data){
            $this->smarty->assign($variable, $data);
        }
        $this->smarty->display($template);
    }

    private static $instance;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    final private function __wakeup()
    {
    }

    public static function getInstance(): ViewService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}