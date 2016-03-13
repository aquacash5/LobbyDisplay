<!DOCTYPE HTML>
<?php
/*
    Author:      Kyle Bloom
    Date:        06/13/2014
	Modified:    03/11/2016
    Description: Displays the Admin Contorl Panel
*/
if(file_exists("settings.txt"))
{
	$file = fopen("settings.txt","r");
	$fileString = "";
	while(!feof($file)) {
		$fileString .= fgets($file); 
	}
	fclose($file);
}
else
{
	// If there is an error with reading the file
	$fileString = "";
}
$fileArray = explode("\n", $fileString);  // Creates an array split at the lines
?>

<html>
    <head>
        <title>Admin Control Panel</title>
        <link HREF="default.css" type="text/css" MEDIA="screen" REL="stylesheet" />
        <script type="text/javascript" src="index.js"></script>
    </head>
    <body>
        <div ID="console">
            <h1>Admin Control Panel</h1>
            <form ACTION="settings.php" method="post">
                <table id="controlTable">
                    <tr>
                        <td colspan="2">
							Banner Text
						</td>
                        <td colspan="4">
							<textarea ID="bannerInput" type="text" style="width:100%" name="bannertext"><?php echo $fileArray[0]  // Inserts the bannertext into the bannerInput textarea ?></textarea>
						</td>
                    </tr>
                    <tr>
                        <td colspan="2">
							Emergency Text
						</td>
                        <td colspan="4">
							<textarea ID="emergencyInput" type="text" style="width:100%" name="emergencytext" ><?php if(count($fileArray) >= 2) echo $fileArray[1];  // Inserts the emergencytext into the emergencyInput textarea ?></textarea>
						</td>
                    </tr>
                    <?php
						// Loops through the file starting at the third line
                        for($i = 2; $i < count($fileArray); $i++)
                        {
							// Splits the line by commas
                            $event = explode("," , $fileArray[$i]);
                            // Event Name
                            echo "<tr>\n <td>Event ";
                            echo $i-1 . "</td>";
                            echo "<td><input type=\"text\" name=\"eventtext[" . ($i-1) . "]\" style=\"width:95%\" value=\"";
                            echo $event[0];
                            echo "\" /></td>\n ";
                            // Event Time
                            echo "<td>Time</td>";
                            echo "<td><input type=\"time\" name=\"eventtime[" . ($i-1) . "]\" style=\"width:95%\" value=\"";
                            echo $event[1];
                            echo "\" /></td>\n ";
                            // Event Room
                            echo "<td>Room</td>";
                            echo "<td><input type=\"text\" name=\"eventroom[" . ($i-1) . "]\" style=\"width:100%\" value=\"";
                            echo $event[2];
                            echo "\" /></td>\n";
                            echo "</tr>\n";
                        }
                    ?>
                    <tr>
                        <td colspan="2">
							<input type="submit" name="submit" value="Save Changes" />
						</td>
                        <td colspan="3"/>
                        <td style="text-align:right">
							<button type="button" onclick="addRow()" name="addrow">
								Add Row
							</button>
						</td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>