<?php
class Table{

    private $columns;

    function __construct($columns) {
        $this->columns = $columns;
    }

    function render($data) {

        $table =
            '<table class="table table-hover">
                <thead>
                    <tr>
                    @columns
                    </tr>
                </thead>
                <tbody>
                    @rows
                </tbody>
            </table>';

        $col = '';
        $rows = '';

        foreach ($this->columns as $column) {
            $col .= "<td>$column</td>";
        }
        
        foreach ($data as $item){
            $row = '<tr>';
        
            foreach ($this->columns as $column => $value){
                
                if($column == 'id' || $column == 'name' || $column == 'username'){
                    $row .= "<td><a class='userDetails' data-id='".$item->id."'>".$item->$column ."</td>";
                }else{
                    $row .= "<td>".$item->$column ."</td>";
                }
                
            }
            $row .= "</tr>";
            $rows .= $row;
        }
        $table = str_replace("@columns",$col, $table);
        $table = str_replace("@rows", $rows, $table );
        return $table;
    }
}