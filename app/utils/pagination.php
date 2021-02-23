<?php
include_once('../utils/autoload.php');
spl_autoload_register("autoload");

use app\components\Button;


function pagination($page, $total_records)
{
    $position = $page;

    $start = $position - 1;
    $start = $start * $total_records;

    return [$start, $total_records, $position];
}

function printTheButtons($total, $total_records, $position)
{

    $total_pages = $total / $total_records;

    $previous = $position - 1;
    $next = $position + 1;

    if ($position > 1) {
        $previous_button = new Button("<- Anterior", "button", $previous);
        $previous_button->getButton();
    }
    if ($position < $total_pages) {
        $next_button = new Button("Próxima ->", "button", $next);
        $next_button->getButton();
    }
}
