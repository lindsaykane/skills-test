<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Table;

/**
 * Table controller
 */
class TableController extends \Core\Controller
{
    /**
     * Show the table page
     */
    public function generateTableAction() {
        $return = [];

        if(isset($_FILES) && isset($_FILES['fileToUpload']) && isset($_FILES['fileToUpload']['type']) && $_FILES['fileToUpload']['type'] == 'application/json') {
            $table = new Table();
            $return = $table->jsonToArray($_FILES);
            $return['error'] = 200;
        } else {
            $return['error'] = 400;
        }
        View::renderTemplate('table.html',$return);
    }
}
