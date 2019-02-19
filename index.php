<?php
/**
 * Created by PhpStorm.
 * User: yipei
 * Date: 2/19/19
 * Time: 10:11 AM
 */

main::start();

class main {

    static public function start() {

        $file = fopen( "example.csv", "r");

        while(! feof($file))
        {

            print_r(fgetcsv($file));
        }

        fclose($file);

    }

}