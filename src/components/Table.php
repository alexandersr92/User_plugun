<?php
class Table{

    private $columns;

    function __construct($columns) {
        $this->columns = $columns;
    }

    function render($data) {
        global $wpdb;
        $table = $wpdb->prefix . 'options';
        $theme = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_theme'")[0]->option_value;
        $tableTheme = ($theme == 'dark') ? 'table-dark' : 'light-theme';
        $table =
            "<table class='table table-hover $tableTheme'>
                <thead>
                    <tr>
                    @columns
                    </tr>
                </thead>
                <tbody>
                    @rows
                </tbody>
            </table>";

        $col = '';
        $rows = '';

        foreach ($this->columns as $column) {
            $col .= "<td>$column</td>";
        }
        if(!empty($data)) {
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
        }else{
            $rows = "<tr><td  colspan='5'><center>Sorry, no data yet!</center></tr></td>";
        }
     
        $table = str_replace("@columns",$col, $table);
        $table = str_replace("@rows", $rows, $table );
        return $table;
    }
}
//hacer que el css sea dinamico para usar themes desde el admin