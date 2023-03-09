<?php

function show_error($validation, $field)
{
    if($validation->hasError($field))
    {
        return $validation->getError($field);
    }
}

function get_date($date)
{
	return date("jS M, Y",strtotime($date));
}

function get_date2($date)
{
	return date("M d, Y",strtotime($date));
}

?>