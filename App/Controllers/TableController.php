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

        $table = new Table();

        $setFileContents = $table->setFileContents($_FILES);
        $return['error'] = $setFileContents['error'];

        if($return['error'] == 200) {
            $return = $table->jsonToArray();
        }

        View::renderTemplate('table.html',$return);
    }
}
