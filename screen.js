/*
	Author:     Kyle Bloom
	Date:       06/13/2014
	Modified:   03/11/2016
	Description: Updates screen.htm every 10 seconds
*/

/*
	Gets settings information and sends the text to updateScreen
*/
function update()
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function ()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			updateScreen(xmlhttp.responseText);  // Send responseText to updateScreen
		}
	}
	xmlhttp.caching = false;
	xmlhttp.open("GET", "settings.txt", true);
	xmlhttp.send();
	setTimeout(function(){update();}, 10000);  // Creates a function that calls update in 10 seconds
}

/*
	Updates the screen with the contents of the file
*/
function updateScreen(fileText)
{
	document.getElementById("display").innerHTML = "<tr id=\"headings\">" +
												   "<th id=\"eventCell\" width=\"45%\"><label id=\"eventHeading\">Event</label></th>" +
												   "<th id=\"eventCell\" width=\"20%\"><label id=\"timeHeading\">Time</label></th>" +
												   "<th id=\"eventCell\" width=\"35%\"><label id=\"roomHeading\">Room</label></th></tr>";
	var fileArray = fileText.split("\n");
	document.getElementById('ticker').innerHTML = fileArray[0];  // Sets the top marque to the bannertext at the top of the file
	if(fileArray[1] == "")
	{
		document.getElementById('marFoot').style.visibility = 'hidden';  // Sets bottom marque to hidden if emergencytext is empty
	}
	else
	{
		document.getElementById('marFoot').style.visibility = "visible";      // Sets bottom marque to visible if emergencytext has text
		document.getElementById('emergencyticker').innerHTML = fileArray[1];  // Sets bottom marque text to emergencytext
	}
	var table = document.getElementById("display");
	var row;
	var column1;
	var column2;
	var column3;
	var tableArray;
	for(var i = 2; i < fileArray.length; i++)  // Loops through the file starting at the third line
	{
		tableArray = fileArray[i];
		tableArray = tableArray.split(",");        // Split the line by commas
		row = table.insertRow(table.rows.length);  // Inserts new row into the table
		column1 = row.insertCell(0);               // Inserts new Cells into the row
		column2 = row.insertCell(1);
		column3 = row.insertCell(2);

		column1.innerHTML = tableArray[0];                  // Inserts the eventtext into the first column
		column2.innerHTML = fomartTimeShow(tableArray[1]);  // Inserts the eventtime into the second column formated into 12-hour clock format
		column3.innerHTML = tableArray[2];                  // Inserts the eventroom into the thrid column

		row = table.insertRow(table.rows.length);  // Inserts a new row and fills it with nothing to give the display spacing
		column1 = row.insertCell(0);
		column1.innerHTML = "&nbsp;";
	}
}

/*
	Converts 24-hour clock format to 12-hour clock format
*/
function fomartTimeShow(h_24)
{
	var h = h_24.split(":")[0] % 12;
	if (h === 0) h = 12;
	return (h < 10 ? "0" + h : h) + ":" + h_24.split(":")[1] + (h_24.split(":")[0] < 12 ? ' AM' : ' PM');
}
