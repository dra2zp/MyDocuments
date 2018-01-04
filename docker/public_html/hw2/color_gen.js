// This code will allow us to enter the number of boxes to display horizontally and vertically
// Given the number of rows and columns, the code will randomly generate colors to display to the viewport

// wait until the DOM is fully-loaded

// same as
// $(document).ready(handler)

$(function() {
    // this function will be called when the DOM is finally rendered.
    $("#test").click(function(evt) {
	// this is what will happen when the "Test Colors" button is clicked
	evt.preventDefault();
	// remove all of the children nodes under the div element with id "colors" in order to reset the grid
	var parent_node = document.getElementById("colors");
	while (parent_node.firstChild) {
	    parent_node.removeChild(parent_node.firstChild);
	}
	// Validation of form input
	var hor = $("#horizontal").val();
	if (hor === "" || hor < 1 || hor > 999 || Math.floor(hor) != hor || Math.ceil(hor) != hor) {
	    alert("Please enter a positive integer less than 1000 for the number of horizontal boxes to display");
	    return;
	}
	var ver = $("#vertical").val();
	if (ver === "" || ver < 1 || ver > 999 || Math.floor(ver) != ver || Math.ceil(ver) != ver) {
	    alert("Please enter a positive integer less than 1000 for the number of vertical boxes to display");
	    return;
	}
	// both the number of horizontal and vertical boxes are valid
	// we are ready to generate the color matrix
	// pixel size of the viewport's width
	var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
	// pixel size of the viewport's height
	var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	// minimum of the viewport's width and height
	var viewport_size = Math.min(viewport_width, viewport_height);
	// size of the block's width, which is the width of the viewport divided by the number of columns
	var block_width = Math.floor(viewport_width / ver);
	// size of the block's height, which is the height of the viewport divided by the number of rows
	var block_height = Math.floor(viewport_height / hor);
	// size of the block, which is the minimum of the block's width and height, so that the blocks are squares, not
	// rectangles, and so that they are not too big to fit the viewport, which would cause them to overflow to the
	// next line
	var block_size = Math.min(block_width, block_height, Math.floor(viewport_width / hor),
				  Math.floor(viewport_height / ver));
	// add spacing between the "Test Colors" button and the color grid
	$("#colors").append(
	    '<p class="remove">&nbsp</p>'
	);
	for (var i = 0; i < hor; i++) {
	    // the time is used, in part, to generate random numbers, so the colors can be random
	    var t = Date.now();
	    $("#colors").append(
		// start a new div element for the rows
		// inline-block is so the span elements inside thOAe div will appear on the same row
		'<div class="remove" style="display: inline-block; font-size: 0px;">'
	    );
	    for (var j = 0; j < ver; j++) {
		// indexes i and j are used with the time for more random numbers
		var v = t * (1 + i + j);
		// the random red color value
		var r = (Math.floor((v / (Math.random() * Math.pow(10, 3))))) % 256;
		// the random green color value
		var g = (Math.floor((v / (Math.random() * Math.pow(10, 3))))) % 256;
		// the random blue color value
		var b = (Math.floor((v / (Math.random() * Math.pow(10, 3))))) % 256;
		$("#colors").append(
		    // start a new span element for the columns
		    // inline-block is so they will appear next to each other
		    '<span class="remove" style="background-color: rgb(' + r + ',' + g + ',' + b +
			'); display: inline-block; width: ' + block_size + 'px; height: ' + block_size +
			'px; font-size: 0px;"></span>'
		);
		if (j === ver - 1) {
		    $("#colors").append(
			// on the last column, start a new line for the next row
			'</div><br>'
		    );
		}
	    }
	}
	// reset the form values to the empty string to prepare for the next input
	$("#vertical").val("");
	$("#horizontal").val("");
    });
});
