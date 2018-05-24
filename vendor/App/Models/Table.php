<?php

namespace App\Models;

class Table extends \Core\Model
{
    public function jsonToArray($file) {
        $result = [];
        $result['fileContents'] = [];

        $getFileContents = json_decode(file_get_contents($file['fileToUpload']['tmp_name']), true);

        if(is_array($getFileContents)) {
            $result['fileContents'] = $getFileContents;
        }

        return $result;
    }
}
