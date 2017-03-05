<?php
include_once('../components/header.php');

//default sequence given by assignment
$defaultSequence = 'join the nmi team';
?>
    <script src="../jvs/cookieUtils.js" ></script>
    <script src="solution4.js" ></script>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                Solution 4 - String Occurrence Counter
            </h4>
        </div>
        <div role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                Please click <b>Browse</b> and select a file to upload. Click <b>Submit</b> to see the file results.
                <br />
                <br />
                <form id="sequenceCounter" enctype="multipart/form-data">
                    <label for="searchstring">
                        String sequence to search for:
                        <input type="text" name="searchstring" value="<?php echo $defaultSequence; ?>" />
                    </label>
                    <br />

                    <div id="hide-on-submit">
                        <div>

                            <label class="btn btn-info btn-file">
                                Browse <input type="file" name="substring_file">
                            </label>
                            <input class="btn btn-primary" type="button" onclick="initiateSequenceCounter($('form#sequenceCounter'))"
                                   value="Submit"/>
                        </div>
                        <br />
                        <br />
                        <i>The files <b>solution4/string-parsing-input.txt</b> and <b>solution4/string-parsing-input-partial.txt</b> contain sample data.</i>
                    </div>
                </form>
                <div id="show-on-submit" class="hidden">
                    <input class="btn btn-primary" id="reloadButton" type="button" value="Reset" onclick="location.reload()"/>
                    <hr />
                    <h3>Results</h3>
                    <ul id="results">
                    </ul>

                    <h3 class="hidden" id="successMessage">File Analysis Complete!</h3>
                </div>
                <hr />

                <form action="../home.php">
                    <input type="submit" class="btn btn-primary" value="Return to Solutions">
                </form>
            </div>
        </div>
    </div>

<?php
include_once('../components/footer.php');
