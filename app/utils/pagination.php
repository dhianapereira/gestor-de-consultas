<?php

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
        Button::show("<- Anterior", "button", $previous);
    }
    if ($position < $total_pages) {
        Button::show("Próxima ->", "button", $next);
    }
}
