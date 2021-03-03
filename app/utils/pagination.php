<?php

require_once "app/components/Button.php";

function pagination($index, $total_records)
{
    $position = $index;

    $start = $position - 1;
    $start = $start * $total_records;

    return [$start, $total_records, $position];
}

function printTheButtons($total, $total_records, $position, $page)
{

    $total_pages = $total / $total_records;

    $previous = $position - 1;
    $next = $position + 1;

    if ($position > 1) {
        Button::show("<- Anterior", "button", "?page=$page&index=$previous");
    }
    if ($position < $total_pages) {
        Button::show("Próxima ->", "button", "?page=$page&index=$next");
    }
}
