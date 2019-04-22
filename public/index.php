<?php
/**
 * Created by PhpStorm.
 * User: yipei
 * Date: 2/19/19
 * Time: 10:11 AM
 */

main::start( "example.csv");

class main {

    static public function start($filename) {

        $records = csv::getRecords($filename);

        $table = html::generateTable($records);


        }

}

class html {
    public static function generateTable($records) {
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                crossorigin="anonymous">';

        echo'<table class="table table-striped"><thead><tr>';

        $count = 0;
        print("<table border='1'>");
        foreach ($records as $record) {
            if ($count == 0) {
                print("<tr class = 'header'>");
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);
                foreach ($fields as $columnName)
                {
                    print("<th scope='row'>");
                    print_r($columnName);
                    print("</th>");
                }
                print("</tr>");
            }
            {
                print("<tr class='body'>");
                $array = $record->returnArray();
                $values = array_values($array);
                foreach ($values as $columnValue)
                {
                    print("<td>");
                    print_r($columnValue);
                    print("</td>");
                }
                print("</tr>");
            }
            $count++;
        }
        print("</table>");

        print("</html>");
    }
}

class csv {

    static public function getRecords($filename) {


        $file = fopen($filename,"r");
        $filedNames = array();
        $count = 0;

        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0) {

            } else {
                $fieldNames = $record;
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;
    }
}




class record {

    public function __construct(Array $fieldNames =null, $values = null )
    {

        $record = array_combine($fieldNames, $values);

        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }


    }

    public function returnArray() {

        $array = (array) $this;

        return $array;
    }

    public function createProperty($name = "first", $value = "yi") {

        $this->{$name} = $value;

    }
}

class recordFactory {

    public static function create(Array $fieldNames = null, Array $values = null) {


       $record = new record($fieldNames, $values);


        return $record;
    }
}