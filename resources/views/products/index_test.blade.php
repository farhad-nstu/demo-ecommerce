<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body>
	<li>
		<a href="{{ route('home') }}"><b>Back</b></a>
	</li>
	<div class="card-body">	
		<div class>
			<input type="text" id="search" name="search" placeholder="search here">
		</div>
		<div class="">
			<h3 align="center">Total Data : <span id="total_products"></span></h3>
		
		<table class="table table-bordered " style="width: 70%; margin-top: 50px;" border="1" align="center" >
			<tr>
				<th>#</th>
				<br>
				<th>Title</th>			
				<th>Buying_price</th>
				<th>Selling_pr ice</th>
				<th>Category</th>
				<th>Sub Category</th>
				<th>Picture</th>		
				<th>Action</th>
			</tr>

			<tbody>
				 
			</tbody> 
		</table>
		</div>
	</div>
	</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){
		fetch_product();

		function fetch_product(query = '')
		{
			$.ajax({
				url:"{{ route('product_search.action') }}",
				method: 'GET',
				data:{query:query},
				dataType:'json',
				success:function(data){
					$('tbody').html(data.table_data);
					$('#total_products').text(data.total_products);
				}
			});
		}

		$(document).on('keyup', '#search', function(){
			var query = $(this).val();
			fetch_product(query);
		});
	});
</script>
		

