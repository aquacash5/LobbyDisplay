<!DOCTYPE html>
<?php

/*
    * Author: Kyle Bloom
    * Date: 06/13/2014
    * Project:
    * File Description: Displays the Admin Contorl Panel
*/

    try
    {
        $file = fopen("settings.txt","r"); //Opens the settings.txt file
        $fileString = "";
        while(!feof($file)) { //Reads file to  the end
            $fileString .= fgets($file) . "\n"; 
        }
        fclose($file); //close file
    }
    catch(Exception $e) {
        $fileString = ""; //If there is an error with reading the file
    }
    $fileArray = explode("\n", $fileString); //Creates an array split at the lines
?>

<HTML>
    <HEAD>
        <TITLE>Admin Control Panel</TITLE>
        <LINK HREF="default.css" TYPE="text/css" MEDIA="screen" REL="stylesheet" />
        <SCRIPT type="text/javascript" src="index.js"></SCRIPT>
    </HEAD>
    <BODY>
        <DIV ID="console">
            <H1>Admin Control Panel</H1>
            <FORM ACTION="settings.php" method="post">
                <TABLE id="controlTable">
                    <TR>
                        <TD colspan="2">Banner Text</TD>
                        <TD colspan="4"><textarea ID="bannerInput" TYPE="text" style="width:100%" NAME="bannertext" ><?php echo $fileArray[0] /*Inserts the bannertext into the bannerInput textarea*/ ?></textarea></TD>
                    </TR>
                    <TR>
                        <TD colspan="2">Emergency Text</TD>
                        <TD colspan="4"><textarea ID="emergencyInput" TYPE="text" style="width:100%" NAME="emergencytext" ><?php if(count($fileArray) >= 2) echo $fileArray[1]; /*Inserts the emergencytext into the emergencyInput textarea*/ ?></textarea></TD>
                    </TR>
                    <?php
                        for($i = 2; $i < count($fileArray)-1; $i++) //Loops through the file starting at the third line
                        {
                            $event = explode("," , $fileArray[$i]); //Splits the line by commas

                            //Event Name
                            echo "<TR>\n <TD>Event ";
                            echo $i-1 . "</TD>";
                            echo "<TD><INPUT TYPE=\"text\" NAME=\"eventtext[" . ($i-1) . "]\" style=\"width:95%\" VALUE=\"";
                            echo $event[0];
                            echo "\" /></TD>\n "; //Adds an input with the eventtext filld out with file eventtext from the line of the text file

                            //Event Time
                            echo "<TD>Time</TD>";
                            echo "<TD><INPUT TYPE=\"time\" NAME=\"eventtime[" . ($i-1) . "]\" style=\"width:95%\" VALUE=\"";
                            echo $event[1];
                            echo "\" /></TD>\n ";//Adds an input with the eventtime filld out with file eventtime from the line of the text file

                            //Event Room
                            echo "<TD>Room</TD>";
                            echo "<TD><INPUT TYPE=\"text\" NAME=\"eventroom[" . ($i-1) . "]\" style=\"width:100%\" VALUE=\"";
                            echo $event[2];
                            echo "\" /></TD>\n";//Adds an input with the eventroom filld out with file eventroom from the line of the text file

                            echo "</TR>\n";
                        }
                    ?>
                    <TR>
                        <TD colspan="2"><INPUT TYPE="submit" NAME="submit" VALUE="Save Changes" /></TD>
                        <TD colspan="3"/>
                        <TD STYLE="text-align:right"><BUTTON TYPE="button" ONCLICK="addRow()" NAME="addrow" >Add Row</BUTTON></TD>
                    </TR>
                </TABLE>
            </FORM>
        </DIV>
    </BODY>
</HTML>