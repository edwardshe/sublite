function draw_bar_graph(chart_id, my_data)
{
	var key_array = new Array();
	var value_array = new Array();

	for(var key in my_data)
	{
		key_array.push(key);
		value_array.push(my_data[key]);
	}

	var data = {
	    labels: key_array,
	    datasets: [
	        {
	            label: "My dataset",
	            fillColor: "rgba(151,187,205,0.5)",
	            strokeColor: "rgba(151,187,205,0.8)",
	            highlightFill: "rgba(151,187,205,0.75)",
	            highlightStroke: "rgba(151,187,205,1)",
	            data: value_array
	        }
	    ]
	};

	var ctx = document.getElementById(chart_id).getContext('2d');
	var myBarChart = new Chart(ctx).Bar(data);
}

function draw_line_graph(chart_id, my_data)
{
	var key_array = new Array();
	var value_array = new Array();

	for(var i = 0; i < my_data.length; i++)
	{
		key_array.push(my_data[i][0]);
		value_array.push(my_data[i][1]);
	}

	var data = {
	    labels: key_array,
	    datasets: [
	        {
	            label: "My First dataset",
	            fillColor: "rgba(151,187,205,0.2)",
	            strokeColor: "rgba(151,187,205,1)",
	            pointColor: "rgba(151,187,205,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(151,187,205,1)",
	            data: value_array
	        }
	    ]
	};

	var ctx = document.getElementById(chart_id).getContext('2d');
	var myLineChart = new Chart(ctx).Line(data);
}