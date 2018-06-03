<?php
/**
 * Created by PhpStorm.
 * Users: DevProsper
 * Date: 14/03/2018
 * Time: 22:55
 */

namespace Core\Html;


class BootstrapForm extends Form
{

    public $errors = [];
    public $data;

    protected function surround($html){
        return "<div class=\"form-group\">{$html}</div>";
    }

    public function input($name,$label = null,$options = []){
        $label = '<label>'.$label.'</label>';
        $type = isset($options['type']) ? $options['type'] : 'text';
        if($type === 'textarea'){
            $input = '<textarea name="'.$name.'" class="form-control">' .$this->getValue($name).'</textarea>';
        }else{
            $input = '<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'" class="form-control">';
        }
        if (isset($errors[$name])) {
            ?>
            <p class="help-block"><?= $errors[$name]; ?></p>
            <?php
        }
        return $this->surround($label . $input);
    }

    public function submit(){
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

    public function select($name, $label, $options)
    {
        $label = '<label>'.$label.'</label>';
        $input = '<select class="form-control" name="'.$name.'">';
        foreach($options as $k => $v){
        $attributes = '';
        if ($k == $this->getValue($name)) {
        	$attributes = ' selected';
        }
            $input .= "<option value='$k'$attributes>$v</option>";
        }
        $input .= '</select>';

        return $this->surround($label . $input);
    }

    public function select2($id, $options = array()){

        $return = "<select class='form-control' id='$id' name='$id'>";
        foreach ($options as $k => $v) {
            if (!isset($_POST[$id]) && empty($_POST[$id])) {
                $return .= "<option value=''>-- Selectionner ---</option>";
            }
            $selected = '';
            if (isset($_POST[$id]) && $k == $_POST[$id]) {
                $selected = 'selected="selected"';
            }
            $return .= "<option value='$k' $selected>$v</option>";
        }
        $return .= "</select>";
        return $return;
    }
}