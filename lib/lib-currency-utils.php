<?php

/**
 * Accepts a float or integer number, adds a $, thousands separator and
 *  rounds to 2 decimal palces for display
 * @param $val
 * @return mixed
 */
function getUSDDollarAmount($val) {
    return number_format(round($val , 2), 2, '.', ',');
}