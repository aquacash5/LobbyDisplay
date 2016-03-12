<?php

/*
    * Author: Kyle Bloom
    * Date: 06/13/2014
    * Project:
    * File Description: Writes the new display settings to settings.txt, then returns the user to the admin panel
*/

    $file=fopen("settings.txt", "w") or exit("Fail"); //Opens the settings.txt file else exit

    try
    {
        $bannerText = trim(str_replace("\n", " ", $_POST['bannertext'])); //Removes any new lines from bannertext
        fwrite($file, $bannerText); //Write the bannertext to the file
    }
    catch(Exception $e)
    {
    }
 
    try
    {
        $emergencyText = PHP_EOL.trim(str_replace("\n", " ", $_POST['emergencytext'])); //Removes any new lines from emergencytext
        fwrite($file, $emergencyText); //Writes emergencytext to file
    }
    catch(Exception $e)
    {
        fwrite($file, PHP_EOL);//If there is not emergencytext then it writes a blank line
    }

    $eventText = $_POST['eventtext']; //Gets an array of event texts
    $eventTime = $_POST['eventtime']; //Gets an array of event times
    $eventRoom = $_POST['eventroom']; //Gets an array of event rooms
    for($i=1;$i<=count($eventText);$i++) //Cycles through the events
    {
        if($eventText[$i] != "")// if the event text is empty then skip it. Effectively deleting it.
        {
            $event = PHP_EOL.$eventText[$i].",".$eventTime[$i].",".$eventRoom[$i]; //Constructs a string consisting of the event text, time, and rooms sperated by commas
            fwrite($file, $event); //Writes event to file
        }
    }
    fflush($file); //Ensures file is written to the hard disk
    fclose($file); //Closes the file settings.txt
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
    <HEAD>
        <title>Admin Control Panel</title>
        <!-- Redirects browser to index.php -->
        <meta http-equiv="REFRESH" content="0;url=index.php">
    </HEAD>
    <BODY>
        Redirecting...
    </BODY>
</HTML>
