<?php
/**
 * Created as InktController.php.
 * Developer: Hamza Waqas
 * Date:      5/16/13
 * Time:      7:14 PM
 */

namespace Instinktech;

use \Fuel\Core\Controller_Template;

class InktController extends Controller_Template {

    /**
     *  Loads the View.
     * @author  Hamza Waqas
     * @param $path
     *
     */
    protected function setView($path) {
        $this->template->content = \View::forge($path);
    }

    /**
     *  Sets the page title
     *  @author HamzaW aqas
     * @param $title
     */
    protected function setTitle($title) {
        $this->template->title = $title;
    }


}