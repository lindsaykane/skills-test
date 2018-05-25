<?php

namespace App\Models;

class Table extends \Core\Model
{
    private $fileContents;

    public function getFileContents() {
        return $this->fileContents;
    }

    public function setFileContents($file) {
        $return = [];

        if(isset($_FILES) && isset($_FILES['fileToUpload']) && isset($_FILES['fileToUpload']['type']) && $_FILES['fileToUpload']['type'] == 'application/json') {
            $return['error'] = 200;
        } else {
            $return['error'] = 400;
        }

        $this->fileContents = $file;

        return $return;
    }

    public function jsonToArray() {
        $result = [];
        $result['fileContents'] = [];

        $this->setFileContents($this->fileContents);

        $getFileContents = json_decode(file_get_contents($this->fileContents['fileToUpload']['tmp_name']), true);

        $getFileContents = $this->array_msort($getFileContents, array('LName'=>SORT_DESC));

        if(is_array($getFileContents)) {
            $result['fileContents'] = $getFileContents;
        }

        return $result;
    }

    private function array_msort($array, $cols) {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }
}
