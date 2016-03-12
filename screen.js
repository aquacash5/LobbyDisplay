/*
    * Author: Kyle Bloom
    * Date: 06/13/2014
    * Project:
    * File Description: Updates screen.htm every 10 seconds
*/

function logItem(logInfo) //Sends logInfo to log.php
{
    var logPost = new XMLHttpRequest();
    logPost.open("POST","log.php",true); //Opens a link to log.php
    logPost.send("logInfo=" + btoa(logInfo)); //Sends logInfo in base64 format to log.php
    logPost.close(); //Close connection
}

function update() //Reads settings.txt and sends the text to updateScreen
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () //Creates the function to send the data to updateScreen
    {
        logItem("Update Ready State: " + xmlhttp.readyState + " Status: " + xmlhttp.status);    //Send log with the current status of the download
                                                                                                //ex: Update Ready State: 4 Status: 200
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) //If true then the file is finished
        {
            logItem("Read File Success"); //Send Read File Success to log
			updateScreen(xmlhttp.responseText); //Send responseText to updateScreen
		}
	}
	xmlhttp.open("GET","settings.txt",true); //Trys to open settings.txt setting off the function just declared above
	xmlhttp.send(); //Sends Request for file
	setTimeout(function(){update();}, 10000); //Creates a function that calls update in 10 seconds
}

function updateScreen(fileText) //Updates the screen with the contents of the file
{
    logItem("Screen Update Begins"); //Send Screen Update Begins
    
	document.getElementById("display").innerHTML = "<TR id=\"headings\">"+ //Creates the table headers
												"<TD id=\"eventCell\" width=\"45%\"><label id=\"eventHeading\">Event</label></TD>"+
												"<TD id=\"eventCell\" width=\"20%\"><label id=\"timeHeading\">Time</label></TD>"+
												"<TD id=\"eventCell\" width=\"35%\"><label id=\"roomHeading\">Room</label></TD></TR>";
	var fileArray = fileText.split("\n"); //Splits the file by line
	document.getElementById('ticker').innerHTML = fileArray[0]; //Sets the top marque to the bannertext at the top of the file
	if(fileArray[1] === "")
    {
		document.getElementById('marFoot').style.visibility = 'hidden'; //Sets bottom marque to hidden if emergencytext is empty
        logItem("Set Emergancyticker to Hidden"); //Sends "Set Emergancyticker to Hidden" to log
	}
    else
    {
		document.getElementById('marFoot').style.visibility = "visible"; //sets bottom marque to visible if emergencytext has text
		document.getElementById('emergencyticker').innerHTML = fileArray[1]; //sets bottom marque text to emergencytext
        logItem("Set Emergancyticker to Visible"); //Sends "Set Emergancyticker to Visible" to log
	}
	var table = document.getElementById("display"); //Gets the display table
	var row;
	var column1;
	var column2;
	var column3;
	var tableArray;
	for(var i = 2; i < fileArray.length; i++) //Loops through the file starting at the third line
    {
		tableArray = fileArray[i];
		tableArray = tableArray.split(","); //Split the line by commas
		row = table.insertRow(table.rows.length); //Inserts new row into the table
		column1 = row.insertCell(0); //Inserts new Cells into the row
		column2 = row.insertCell(1);
		column3 = row.insertCell(2);

		column1.innerHTML = tableArray[0]; //Inserts the eventtext into the first column
		column2.innerHTML = fomartTimeShow(tableArray[1]); //Inserts the eventtime into the second column formated into 12-hour clock format
		column3.innerHTML = tableArray[2]; //Inserts the eventroom into the thrid column

		row = table.insertRow(table.rows.length); //Inserts a new row and fills it with nothing to give the display spacing
		column1 = row.insertCell(0);
		column1.innerHTML = "&nbsp;";
        
        logItem("Created row " + i-1); //Logs the creation of the new row
	}
}

function fomartTimeShow(h_24) //Converts 24-hour clock format to 12-hour clock format
{
	var h = h_24.split(":")[0] % 12;
	if (h === 0) h = 12;
	return (h < 10 ? "0" + h : h) + ":" + h_24.split(":")[1] + (h_24.split(":")[0] < 12 ? ' AM' : ' PM');
}