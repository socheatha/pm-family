<?php 
    class CustomDate {
        function __construct() {
            $this->data = 'Hello Socheatha 0962195196';
        }
        function date_format($date,$format,$lang)
        {
            if($date){
                $date = date($format, strtotime($date));
                if($lang=="kh"){
                    $date = str_replace(
                        ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'],
                        $date
                    );
                    $date = str_replace(
                        range (0,9),
                        ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'],
                        $date
                    );
                }
            }
            return $date;
        }
    }
?>