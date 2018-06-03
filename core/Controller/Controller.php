<?php
namespace Core\Controller;
use Core\Session\Session;

/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 15/03/2018
 * Time: 11:41
 */
class Controller
{
    protected $session;

    /**
     * Chemin du fichier renvoyer par le controller
     */
    protected $viewPath;

    /**
     * Template qui sera utilisé dans la vue
     */
    public $template;

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

    public function perPage($perPage2){
        if (isset($_GET['pp']) && !empty($_GET['pp']) && ctype_digit($_GET['pp']) == 1) {
            $perPage = $_GET['pp'];
        }else{
            $perPage = $perPage2;
        }
        return $perPage;
    }

    public function current($nbPage,$current2){
        if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1) {
            if ($_GET['p'] > $nbPage) {
                $current = $nbPage;
            }else{
                $current = $_GET['p'];
            }
        }else{
            $current = $current2;
        }
        return $current;
    }

    public function nbPage($total,$perPage){
        $nbPage = ceil($total/$perPage);
        return $nbPage;
    }

    public function parametersPaginate($current,$perPage,$nbPage){
        $current = $this->current($nbPage, $current);
        $firstOpage = ($current-1)*$perPage;
        return $firstOpage;
    }
}