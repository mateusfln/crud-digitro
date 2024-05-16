<?php

function dd(mixed $mixed)
{
    echo"<pre>";
    print_r($mixed);
    die;
}