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

    public function __construct(){
        $this->initHelpers();
        $this->initSmarty();
    }

    private function initSmarty(): void
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
        $smarty->setCompileDir(base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'compile'.DIRECTORY_SEPARATOR);
        $smarty->setCacheDir(base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR);
        $smarty->setCaching(1);
        $this->smarty = $smarty;
    }

    private function initHelpers(): void
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'Helpers'.DIRECTORY_SEPARATOR.'functions.php';
    }

    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @throws SmartyException
     */
    public function render(string $template, array $variables = []): void
    {
        if (!array_key_exists('title', $variables)){
            $variables['title'] = 'Page title';
        }

        if (!array_key_exists('bodyClass',$variables)){
            $variables['bodyClass'] = '';
        }

        foreach ($variables as $variable => $data){
            $this->smarty->assign($variable, $data);
        }
        $this->smarty->display($template);
    }
}