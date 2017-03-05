<?php include_once('../components/header.php'); ?>
<?php include_once('../lib/lib-pricing-utils.php'); ?>
<?php include_once('../lib/lib-currency-utils.php'); ?>
<?php include_once('../lib/lib-file-utils.php'); ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                Solution 1 - Minimum Profit Margin Calculator
            </h4>
        </div>
        <div role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                Please click <b>Browse</b> and select a file to upload. Click <b>Submit</b> to see the file results.
                <br />
                <br />
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="btn btn-info btn-file">
                        Browse <input type="file" name="product_prices">
                    </label>
                    <input class="btn btn-primary" type="submit" />
                </form>
                <br />
                <i>The file <b>solution1/product-costs.txt</b> contains sample data.</i>
                <br />
                <?php
                //getting file data if exists, else get an empty array
                $fileData = isset($_FILES['product_prices']) ? $_FILES['product_prices'] : array();

                //if the file exists
                if(!empty($fileData)) {
                    ?>
                    <hr />
                    <h3>Results - Product Breakeven Prices</h3>
                    <?php
                    $results = array();
                    $results = getFileContents($_FILES['product_prices'], "\r\n", " ", array('txt'));

                    if(empty($results)) {
                        ?>
                        No records found in file.
                        <?php
                    }
                    else {
                        //display the mimium sales prices for each file
                        displayMinimumPrices($results);
                    }

                    ?>
                    <h3>File Analysis Complete!</h3>
                    <?php
                }
                ?>
                <hr />
                <form action="../home.php">
                    <input type="submit" class="btn btn-primary" value="Return to Solutions">
                </form>
            </div>
        </div>
    </div>

<?php include_once('../components/footer.php');
