<?php
// *** Open country data *** //
$debug = false;
if (isset($_GET["debug"])) {
    $debug = true;
}

$myFolder = '../';
$myFileName = 'recipes';
$fileExt = '.csv';
$filename = $myFolder . $myFileName . $fileExt;

if ($debug)
    print '<p>filename is ' . $filename;

$file = fopen($filename, "r");

if ($debug) {
    if ($file) {
        print '<p>File Opened Succesful.</p>';
    } else {
        print '<p>File Open Failed.</p>';
    }
}

// *** Read country Data *** //
if ($file) {
    if ($debug)
        print '<p>Begin reading data into an array.</p>';

    // read the header row, copy the line for each header row
    // you have.
    $headers[] = fgetcsv($file);

    if ($debug) {
        print '<p>Finished reading headers.</p>';
        print '<p>My header array</p><pre>';
        print_r($headers);
        print '</pre>';
    }

    // read all the data
    while (!feof($file)) {
        $countryDetails[] = fgetcsv($file);
    }

    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($countryDetails);
        print '</pre></p>';
    }
} // ends if file was opened 

fclose($file);
include('../top.php');
?>
<article id="countries">
    <h2>Countries</h2>
        <?php
        $lastCountry = "";
        foreach ($countryDetails as $countryDetail) {
            if ($lastCountry != $countryDetail[1]) {
                print '<figure class="country"><a class="country-link" href="country-detail.php?country=';
                print str_replace(' ', '', $countryDetail[1]);
                print '">';
                print '<img class="country-link" alt="';
                print str_replace(' ', '', $countryDetail[1]);
                print '" src="../images/';
                print str_replace(' ', '', $countryDetail[1]);
                print '.jpg">';
                print '</a>';
                print '<figcaption>';
                print $countryDetail[1];
                print '</figcaption></figure>';
                $lastCountry = $countryDetail[1];
            }
        }
        ?>
</article>
<?php
include('../footer.php');
?>
</body>
</html>

