<?php

/**
 * Calculates minimum price for product based on cost and processing fee percentage
 *
 * Variables:
 *
 * P = Price
 * C = Cost
 * F = Processing Fee
 *
 * Equation:
 *
 * P = C / 1 - F
 *
 * @param $cost
 * @param $feePercent
 * @return float|int
 */
function getMinPrice($cost, $feePercent) {
    return $cost / (1 - $feePercent);
}

/**
 * Accepts an array of results from a file and displays the results
 * @param $results
 */
function displayMinimumPrices($results) {
    //counter for tracking row number
    $counter = 1;
    foreach($results as $key => $result) {

        //result[0] = cost, $result[1] = feePercentage
        //storing raw price in case needed later
        $results[$key]['price'] = getMinPrice($result[0], $result[1]);

        //formatting with $, thousands and rounded to 2 decimal places for display
        echo " Line $counter: $" . getUSDDollarAmount($results[$key]['price']) . "<br />";

        //increment for next iteration
        $counter++;
    }
}
