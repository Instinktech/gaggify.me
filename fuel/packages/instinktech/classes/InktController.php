<?php
/**
 * Created as InktController.php.
 * Developer: Hamza Waqas
 * Date:      5/16/13
 * Time:      7:14 PM
 */

namespace Instinktech;

use \Fuel\Core\Controller_Template;
use Parser\View;

class InktController extends Controller_Template {

    public $template = 'template';

    public function before()
    {
        if ( ! empty($this->template) and is_string($this->template))
        {
            // Load the template
            $this->template = \View::forge($this->template);
            $this->template->header = \View::forge('layout/header');
            $this->template->footer = \View::forge('layout/footer');
        }



        return parent::before();
    }

    /**
     *  Loads the View.
     * @author  Hamza Waqas
     * @param $path
     *
     */
    protected function setView($path, $args = array()) {
        $this->template->content = \View::forge($path,$args);
    }

    /**
     *  Sets the page title
     *  @author HamzaW aqas
     * @param $title
     */
    protected function setTitle($title) {
        $this->template->title = $title;
    }

    protected function dump($collection) {
        echo "<pre>"; print_r($collection); exit;
    }

    private function IsMobileUserAgent() {
        return true;
    }


}