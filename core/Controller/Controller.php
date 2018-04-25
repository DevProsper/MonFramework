<?php
namespace Core\Controller;
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 11:41
 */
class Controller
{
    /**
     * Chemin du fichier renvoyer par le controller
     */
    protected $viewPath;

    /**
     * Template qui sera utilisé dans la vue
     */
    protected $template;

    /**
     * Permet de passer les variables à la vue
     */
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