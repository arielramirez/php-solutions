/**
 * This function performs form-submission processes, reads a selected file
 * and initiates a string-occurance crawl for each line in the selected file
 *
 * @param $form
 */
function initiateSequenceCounter($form) {
    //hiding information
    $form.find('div#hide-on-submit').addClass('hidden');

    //ensuring no more clicks are done
    $form.find('input[type=submit]').prop('disable', true);

    //remove the file
    $('#reloadButton').prop('disable', false);

    //display the 'reset' button
    $('#show-on-submit').removeClass('hidden');

    var formData = new FormData($form[0]);

    //tell PHP which function to execute
    formData.append('function', 'extractStringsFromFile');

    //storing the sequence in an array for all future calls
    var sequenceString = $form.find('input[name=searchstring]').val();

    //mapping spaced to pipe for handling
    sequenceString = sequenceString.replace(/ /g, '|');
    var sequence = sequenceString.split('');

    $.ajax({
        url: 'sequencesearch-ajax.php',
        type: 'POST',
        data: formData,
        contentType: false,
        async: false,
        success: function (data) {
            console.log("ajax returned");
            //display any errors returned
            if (data.trim() == 'fail') {
                alert("File read error occurred.");
            }
            else {
                //parse strings returned
                var results = JSON.parse(data);
                var count = 1;
                for(var i in results) {
                    if(results.hasOwnProperty(i)) {
                        //add holder for results to DOM
                        $('ul#results').append("<li id='call" + count + "'>Line " + count + ": Loading. . .</li>");

                        //replacing spaces with pipes for javascript whitespace issue
                        var stringToSearch = results[i].replace(/ /g, '|');
                        stringToSearch = stringToSearch.split('');

                        //initate the executio of the string crawls
                        initiateIndividualStringTraversals(sequence, stringToSearch, count, results.length);
                        count++;
                    }
                }
            }
        },
        cache: false,
        processData: false
    });
}

/**
 * Uses AJAX calls to initiate the string crawl server-side
 *
 * @param sequence
 * @param string
 * @param count
 * @param finalCount
 */
function initiateIndividualStringTraversals(sequence, string, count, finalCount) {
    var formData = new FormData();

    //add necessary date for server
    formData.append('sequence', JSON.stringify(sequence));
    formData.append('string', JSON.stringify(string));

    //indicate wihich function to executes
    formData.append('function', 'findSubsequenceCount');

    $.ajax({
        url: 'sequencesearch-ajax.php',
        type: 'POST',
        data: formData,
        contentType: false,
        success: function (data) {
            //display any errors returned
            if (data.trim() == 'fail') {
                alert("File read error occurred.");
            }
            else {

                //if nothing returned, display
                if(data == '' || data == 0) {
                    data = '0';
                }

                //display results of string crawl in desired formatting
                displayResults(data, count, finalCount);
            }
        },
        cache: false,
        processData: false
    });

}

/**
 * Fills previously added DOM element with the number of results found
 * Formats number to 5 digits with 0's for padding
 *
 * @param numResults
 * @param count
 * @param finalCount
 */
function displayResults(numResults, count, finalCount) {
    //ensuring only last 5 digits are displayed and padded with 0's
    var resultsDisplay = ("00000" + numResults);
    resultsDisplay = resultsDisplay.substr(resultsDisplay.length - 5);

    //creating display string
    var stringToDisplay = "Line " + count + ": " + resultsDisplay;

    //loading the results
    $('ul#results li#call' + count).html(stringToDisplay);

    //indicating that analysis is omplete
    if(count == finalCount) {
        $('#successMessage').removeClass('hidden');
    }
}
