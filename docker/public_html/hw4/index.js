// D.J. Anderson
// dra2zp
// HW 4
// index.js

// wait until the DOM is fully-loaded

// same as
// $(document).ready(handler)

$(function() {
	$("#0").click(function(evt) {
	evt.preventDefault();
	var request = $.ajax({
		type: "GET",
		url: "GradesController.php?data=0",
	});
	var del = document.getElementById("0");
	del.remove();
	});
    $("#1").click(function(evt) {
	evt.preventDefault();
	var del = document.getElementById("sql-table");
	while (del.firstChild) {
	    del.removeChild(del.firstChild);
	}
	var request = $.ajax({
	    type: "GET",
	    url: "GradesController.php?data=1",
	    dataType: "json"
	});
	$("#sql-table").append(
	    '<thead><tr><th onclick="sortTable(0)"><a href="#">First Name</a></th><th onclick="sortTable(1)"><a href="#">Last Name</a></th><th onclick="sortTable(2)"><a href="#">Email</a></th><th onclick="sortTable(3)"><a href="#">Registration Date</a></th></tr></thead><tbody>');
	request.done(function(data) {
	    
	    for (var i = 0; i < data.length; i++) {
		$("#sql-table").append(
		    '<tr><td>' + data[i]["First Name"] + '</td><td>' + data[i]["Last Name"] + '</td><td>' + data[i]["Email"] + '</td><td>' + data[i]["Registration Date"] + '</td></tr>');
	    }
	});
	$("#sql-table").append('</tbody>');
	request.fail(function() {
	    alert("Request failed");
	});
    });

    $("#2").click(function(evt) {
	evt.preventDefault();
	var del = document.getElementById("sql-table");
	while (del.firstChild) {
	    del.removeChild(del.firstChild);
	}
	var request = $.ajax({
	    type: "GET",
	    url: "GradesController.php?data=2",
	    dataType: "json"
	});
	$("#sql-table").append(
	    '<thead><tr><th onclick="sortTable(0)"><a href="#">Department</a></th><th onclick="sortTable(1)"><a href="#">Number</a></th><th onclick="sortTable(2)"><a href="#">Title</a></th></tr></thead><tbody>');
	request.done(function(data) {
	    for (var i = 0; i < data.length; i++) {
		$("#sql-table").append(
		    '<tr><td>' + data[i]["Department"] + '</td><td>' + data[i]["Number"] + '</td><td>' + data[i]["Title"] + '</td></tr>');
	    }
	});
	$("#sql-table").append('</tbody>');
	request.fail(function() {
	    alert("Request failed");
	});
    });

    $("#3").click(function(evt) {
	evt.preventDefault();
	var del = document.getElementById("sql-table");
	while (del.firstChild) {
	    del.removeChild(del.firstChild);
	}
	var request = $.ajax({
	    type: "GET",
	    url: "GradesController.php?data=3",
	    dataType: "json"
	});
	$("#sql-table").append(
	    '<thead><tr><th onclick="sortTable(0)"><a href="#">First Name</a></th><th onclick="sortTable(1)"><a href="#">Last Name</a></th><th onclick="sortTable(2)"><a href="#">Department</a></th><th onclick="sortTable(3)"><a href="#">Number</a></th><th onclick="sortTable(4)"><a href="#">Semester</a></th><th onclick="sortTable(5)"><a href="#">Year</a></th><th onclick="sortTable(6)"><a href="#">Grade</a></th></tr></thead><tbody>');
	request.done(function(data) {
	    for (var i = 0; i < data.length; i++) {
		$("#sql-table").append(
		    '<tr><td>' + data[i]["First Name"] + '</td><td>' + data[i]["Last Name"] + '</td><td>' + data[i]["Department"] + '</td><td>' + data[i]["Number"] + '</td><td>' + data[i]["Semester"] + '</td><td>' + data[i]["Year"] + '</td><td>' + data[i]["Grade"] + '</td></tr>');
	    }
	});
	$("#sql-table").append('</tbody>');
	request.fail(function() {
	    alert("Request failed");
	});
    });

    $("#4").click(function(evt) {
	evt.preventDefault();
	var del = document.getElementById("sql-table");
	while (del.firstChild) {
	    del.removeChild(del.firstChild);
	}
	var request = $.ajax({
	    type: "GET",
	    url: "GradesController.php?data=4",
	    dataType: "json"
	});
	$("#sql-table").append(
	    '<thead><tr><th onclick="sortTable(0)"><a href="#">First Name</a></th><th onclick="sortTable(1)"><a href="#">Last Name</a></th><th onclick="sortTable(2)"><a href="#">Department</a></th><th onclick="sortTable(3)"><a href="#">Number</a></th><th onclick="sortTable(4)"><a href="#">Semester</a></th><th onclick="sortTable(5)"><a href="#">Year</a></th><th onclick="sortTable(6)"><a href="#">Grade</a></th></tr></thead><tbody>');
	request.done(function(data) {
	    for (var i = 0; i < data.length; i++) {
		$("#sql-table").append(
		    '<tr><td>' + data[i]["First Name"] + '</td><td>' + data[i]["Last Name"] + '</td><td>' + data[i]["Department"] + '</td><td>' + data[i]["Number"] + '</td><td>' + data[i]["Semester"] + '</td><td>' + data[i]["Year"] + '</td><td>' + data[i]["Grade"] + '</td></tr>');
	    }
	});
	$("#sql-table").append('</tbody>');
	request.fail(function() {
	    alert("Request failed");
	});
    });
});

function sortTable(n) {
		var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		table = document.getElementById("sql-table");
		switching = true;
		//Set the sorting direction to ascending:
		dir = "asc"; 
		/*Make a loop that will continue until
		no switching has been done:*/
		while (switching) {
		//start by saying: no switching is done:
		switching = false;
		rows = table.getElementsByTagName("TR");
		/*Loop through all table rows (except the
		first, which contains table headers):*/
		for (i = 1; i < (rows.length - 1); i++) {
		//start by saying there should be no switching:
		shouldSwitch = false;
		/*Get the two elements you want to compare,
		one from current row and one from the next:*/
		x = rows[i].getElementsByTagName("TD")[n];
		y = rows[i + 1].getElementsByTagName("TD")[n];
		/*check if the two rows should switch place,
		based on the direction, asc or desc:*/
		if (dir == "asc") {
			if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch= true;
			break;
			}
		} else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}