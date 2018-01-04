// This code will allow us to add To Do Items to the table on the page
// We will also support deleting items from a page
// Finally, when a task is overdue, we will highlight it red

// wait until the DOM is fully-loaded

// same as
// $(document).ready(handler)

$(function() {
    // this function will be called when the DOM is finally rendered
    var request = $.ajax({
	type: "GET",
	url: "todo.json",
	dataType: "json",
	cache: "false"
    });
    request.done(function(data) {
	$.each(data.events, function(id, itm) {
	    $("#todo-body").append(
		'<tr><td>' + itm.desc + '</td><td>' + itm.priority + '</td><td class="todo-date">' + itm.due +
		    '</td><td><span class="glyphicon glyphicon-remove todo-remove"></span>' + '</td></tr>'
	    );
	});
    });
    request.fail(function() {
	alert("Request for file failed.");
    });
    $("#add").click(function(evt) {
	// this is what will happen when the add button is clicked
	evt.preventDefault();

	// Validation of form input
	var desc = $("#description").val();
	if (desc === "") {
	    alert("You have an empty description");
	    return;
	}
	var due = $("#due").val();
	if (due === "" || isNaN((new Date(due)).valueOf())) {
	    alert("You have an invalid due date");
	    return;
	}
	var priority = $("#priority").val();

	// both the description and the due date are valid
	// we are ready to add a row to the table

	$("#todo-body").append(
	    '<tr><td>' + desc + '</td><td>' + priority + '</td><td class="todo-date">' + due +
		'</td><td><span class="glyphicon glyphicon-remove todo-remove"></span>' + '</td></tr>'
	);
	$("#description").val("");
	$("#due").val("");
	$("#priority").val("normal");
    });
    // register a click handler for removing elements from our todo list
    // we filter the click events so that they only occur on the todo-remove spans
    $("#todo").on("click", "table .todo-remove", function(evt) {
	evt.preventDefault();
	// evt.target is the span, parent is td, parent is tr
	$(evt.target).parent().parent().remove();
    });
    // check to see if any events are overdue
    setInterval(function() {
	// this gets called every minute
	// check the time of each entry and highlight if overdue
	$.each($(".todo-date"), function(index, element) {
	    // element is the current DOM node
	    // containing the date to check
	    var date = new Date($(element).text());
	    var curr = new Date();
	    if (date < curr) {
		$(element).parent().addClass("red");
	    }
	});
    }, 60000);
});
