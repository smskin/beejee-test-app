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
        $this->initSmarty();
    }

    private function initSmarty(): void
    {
        $smarty = new Smarty();
        $smarty->setTemplateDir(fix_path(base_path().'/resources/views/'));
        $smarty->setCompileDir(fix_path(base_path().'/storage/framework/views/compile/'));
        $smarty->setCacheDir(fix_path(base_path().'/storage/framework/views/cache/'));
        $smarty->setCaching(1);
        $this->smarty = $smarty;
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