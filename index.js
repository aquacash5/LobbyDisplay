/*
    * Author: Kyle Bloom
    * Date: 06/13/2014
    * Project:
    * File Description: Add Row function for the index page
*/

function addRow() //Add a row to the Admin Control Panel
{
    var table = document.getElementById("controlTable"); //Gets the the controlTable
    var row=table.insertRow(table.rows.length-1);
    var cell0=row.insertCell(0);
    var cell1=row.insertCell(1);
    var cell2=row.insertCell(2);
    var cell3=row.insertCell(3);
    var cell4=row.insertCell(4);
    var cell5=row.insertCell(5);

    cell0.innerHTML="Event " + (table.rows.length-3);
    cell1.innerHTML="<INPUT TYPE=\"text\" STYLE=\"width:95%\" NAME=\"eventtext[" + (table.rows.length-3) + "]\" />";
    cell2.innerHTML="Time";
    cell3.innerHTML="<INPUT TYPE=\"time\" STYLE=\"width:95%\" NAME=\"eventtime[" + (table.rows.length-3) + "]\" />";
    cell4.innerHTML="Room";
    cell5.innerHTML="<INPUT TYPE=\"text\" STYLE=\"width:100%\" NAME=\"eventroom[" + (table.rows.length-3) + "]\" />";
}