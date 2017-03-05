<?php include_once('components/header.php'); ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Solution 1 - Minimum Profit Margin Calculator
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <a class="btn btn-primary" href="solution1/solution1.php">View Solution</a>

                    <hr />

                    <h4>Summary</h4>
                    This solution involved calculating the minimum sales price of a product given the product's
                    price and the processing fee.
                    <br />
                    <br />
                    This was calculated using the given formula:
                    <div class="well well-sm">
                        P = Price
                        <br />
                        C = Cost
                        <br />
                        F = Processing Fee
                        <br />
                        R = Revenue
                        <br />
                        <br />
                        P - (P * F) - C = R
                    </div>

                    To solve this, the below steps were taken:
                    <div class="well well-sm">
                        1. Set revenue to 0 as minimum sales price is required.
                        <br /><br />
                        P - (P * F) - C = 0
                    </div>
                    <div class="well well-sm">
                        2. Add C to both sides to isolate C.
                        <br /><br />
                        P - (P * F) = C
                    </div>
                    <div class="well well-sm">
                        3. Extract P from values on left side to isolate P from F.
                        <br /><br />
                        P * (1 - F) = C
                    </div>

                    <div class="well well-sm">
                        4. Divide both sides by (1 - F) to isolate P.
                        <br /><br />
                        Final Result: P = C / (1 - F)
                    </div>

                    <h4>Files</h4>
                    <ul>
                        <li>solution1/solution1.php</li>
                        <li>solution1/product_costs.txt</li>
                        <li>jsv/formUtils.js</li>
                        <li>lib/lib-pricing-utils.php</li>
                        <li>lib/lib-currency-utils.php</li>
                        <li>lib/lib-file-utils.php</li>
                    </ul>

                    <h4>Notes</h4>
                    <i>No hints were viewed in the making of this solution.</i>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Solution 2 - Billing Calculator Rounding Issue
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <a class="btn btn-primary" href="solution2/solution2.php">View Solution</a>

                    <hr />

                    <h4>Summary</h4>
                    This solution required fixing rounding errors within the function roundDownTotalPriceCents.
                    <br />
                    <br />
                    The PHP function 'floor' can be unreliable when deailng with extremly precise floating
                    point numbers.
                    <br />
                    <br />
                    The solution chosen is the php function number_format(x, 2). This function ignores any
                    digits after the second floating point, which ensures that the values
                    is always rounded down.
                    <br />
                    <br />
                    There were multiple solutions available for solving this problem including using strval(),
                    overflow typecasting and adjusting the system floating point precision (BAD IDEA). I chose the
                    function number_format is this is clean, simple and gets exactly what we need.
                    <br />
                    <br />
                    Additionally, validation was added for the $monthlyPrice input to verify
                    the business rule "the monthlyPrice will never contain fractions of a cent".
                    <br /><br />
                    Updated roundDownTotalPriceCents function:
                    <br /><br />
                    <div class="well well-sm">
                        function roundDownTotalPriceCents($monthlyPrice, $monthsUsed)
                        {
                        <div class="padding-left-20">
                            //validate given monthly price to verify no fractions of cents
                            <br />
                            $monthlyPriceValidated = round($monthlyPrice, 2);
                            <br />
                            <br />
                            //calcuating amount due
                            <br />
                            $rawTotal = $monthlyPrice * $monthsUsed;
                            <br /><br />
                            //removing fractions of cents to 'round down'
                            <br />
                            $amtDue = number_format($rawTotal, 2);
                            <br />
                            <br />
                            return $amtDue;
                        </div>
                        }
                    </div>

                    <h4>Files</h4>
                    <ul>
                        <li>solution2/solution2.php</li>
                    </ul>

                    <h4>Notes</h4>
                    <i>No hints were viewed in the making of this solution.</i>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Solution 3 - Excel Display Hyperlink Repair
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <a class="btn btn-primary" href="solution3/solution3.php">View Example 1</a>
                    <a class="btn btn-primary" href="solution3/example2.php">View Example 2</a>

                    <hr />

                    <h4>Summary</h4>
                    This problem involved finding an encoding bug in excel_reader_2.php.
                    <br />
                    <br />
                    Hyperlinks contain the '/' character which were corrupting the file text being read
                    from xls.
                    <br />
                    <br />
                    Changes made:
                    <ol>
                        <li>Removed the UTF16-LE encoding on the hyperlink string. This encoding was useless
                            as the  hyperlink was corrupt.</li>
                        <li>Stripped all non-ASCII characters from the URL string. This removed the corruption
                            of the hyperlink safely as no non-ASCII characters should exist in a hyperlink </li>
                    </ol>

                    Only line 1555 was changed.
                    <div class="well well-sm">
                        Previous line 1555:
                        <br />
                        $linkdata['link'] = $this->_encodeUTF16($ulink);
                        <br />
                        <br />
                        New line 1555:
                        <br />
                        $linkdata['link'] = preg_replace( '/[^[:print:]]/', '',$ulink);
                    </div>

                    <h4>Files</h4>
                    <ul>
                        <li>solution3/solution3.php</li>
                        <li>solution3/example.xls</li>
                        <li>solution3/example2.php</li>
                        <li>solution3/example2-excel.xls</li>
                        <li>solution3/excel_reader_2.php</li>
                    </ul>

                    <h4>Notes</h4>
                    <i>No hints were viewed in the making of this solution.</i>
                    <br />
                    <i>A second example is provided for review purposes only.</i>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headerFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Solution 4 - String Occurrence Counter
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headerFour">
                <div class="panel-body">
                    <a class="btn btn-primary" href="solution4/solution4.php">View Solution</a>

                    <hr />

                    <h4>Summary</h4>
                    This problem involved creating a string-analyzing algorithm to identify the number of
                    unique paths which a series of characters can be traversed.
                    <br />
                    <br />
                    The logic for this solution was implemented based on the algorithm on this website:
                    <div class="well well-sm">
                        http://www.geeksforgeeks.org/count-distinct-occurrences-as-a-subsequence/
                    </div>
                    AJAX is used to initiate the individual string analysis. The action sequence-counting
                    is done in PHP.
                    <br />
                    <br />
                    This client/server division was selected to eliminate the risk of the PHP connection
                    timing out for a file with several thousand strings to analyze.
                    <h4>Files</h4>
                    <ul>
                        <li>solution4/solution4.php</li>
                        <li>solution4/solution4.js</li>
                        <li>solution4/string-parsing-input.php</li>
                        <li>solution4/string-parsing-input-partial.php</li>
                        <li>solution4/sequencesearch-ajax.php</li>
                        <li>lib/lib-file-utils.php</li>
                    </ul>

                    <h4>Notes</h4>
                    <i>No hints were viewed in the making of this solution.</i>
                    <i>The ability to customize the sought sequence was added for extra kicks.</i>
                </div>
            </div>
        </div>
    </div>
<?php include_once('components/footer.php'); ?>