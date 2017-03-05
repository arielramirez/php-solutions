<?php
error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include_once('../components/header.php');

// Return true if the two numbers match
function compareNumbers($a, $b) {
    return ($a == $b);
}

// This function will calculate the total amount to charge a customer for a particular service.
// Given the monthlyPrice of the service and monthsUsed, calculate the total amount to charge the
// customer.
//
// Note: The total amount should always be rounded down to the cent below AKA ignore trailing digits
//              after 2 decimal places as PHP's floor function is prone to rounding errors
// Note: monthlyPrice will never contain fractions of a cent
function roundDownTotalPriceCents($monthlyPrice, $monthsUsed)
{
    //validate given monthly price to verify no fractions of cents
    $monthlyPriceValidated = round($monthlyPrice, 2);

    //calcuating amount due
    $rawTotal = $monthlyPrice * $monthsUsed;

    //removing franctions of cents to 'round down'
    $amtDue = number_format($rawTotal, 2);

    return $amtDue;
}

?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                Solution 1 - Minimum Profit Margin Calculator
            </h4>
        </div>
        <div role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <?php
                // All of these assertions should be true when you've fixed the above functions
                // DO NOT CHANGE ASSERTIONS

                //Dev Note: no changes made to assertions - just added formatting below
                ?>

                Asserted <?php echo assert(compareNumbers(1, 1)); ?> for compareNumbers(1, 1)
                <br />
                Asserted <?php echo assert(compareNumbers('123000000000000000124', '123000000000000000124')); ?>
                for compareNumbers('123000000000000000124', '123000000000000000124')
                <br />
                Asserted <?php echo assert(compareNumbers(1, '1')); ?> for compareNumbers(1, '1')
                <br />
                Asserted <?php echo assert(!compareNumbers('123000000000000000125', '123000000000000000124')); ?>
                for !compareNumbers('123000000000000000125', '123000000000000000124')
                <br />
                <br />
                Asserted <?php echo assert(roundDownTotalPriceCents(1, 30/30) == 1.00); ?>
                for roundDownTotalPriceCents(1, 30/30) == 1.00
                <br />
                Asserted <?php echo assert(roundDownTotalPriceCents(10.53, 60/30) == 21.06); ?>
                for roundDownTotalPriceCents(10.53, 60/30) == 21.06
                <br />
                Asserted <?php echo assert(roundDownTotalPriceCents(1.20, 45/30) == 1.80); ?>
                    for roundDownTotalPriceCents(1.20, 45/30) == 1.80)
                <br />
                Asserted <?php echo assert(roundDownTotalPriceCents(1.20, 10/30) == 0.4); ?>
                    for roundDownTotalPriceCents(1.20, 10/30) == 0.4)
                <br />

                <hr />
                <form action="../home.php">
                    <input type="submit" class="btn btn-primary" value="Return to Solutions">
                </form>
            </div>
        </div>
    </div>
<?php

include_once('../components/footer.php');

