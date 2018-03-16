<?php
namespace App\Core\Controller;
/**
 * Created by PhpStorm.
 * User: DevProsper
 * Date: 15/03/2018
 * Time: 11:41
 */
class Controller
{
    protected $viewPath;
    protected $template;

    /**
     * Permet de passer les variables à la vue
     **/
    public $vars = array();

    /**
     * Permet de rendre la vue
     * @param $view
     * @param array $variables
     */
    public function render($view, $variables = []){
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'template/' . $this->template . '.php');
    }

}