<script>

	$(document).ready(function(){

		//Send and receive data using AJAX request
		 function fetch_data(query, uri){

		 	$.ajax({
			   url:uri,
			   method:'GET',
			   data:query,
			   dataType:'json',

			   success:function(data)
				   {
				    //console.log(data);
				    $('tbody').html(data);
				   },

			    error: function (data) 
			    	{
			        var errors = $.parseJSON(data.responseText);
			        $.each(errors, function (key, value) 
				        {
				            $('tbody').html('<tr><td align="center" colspan="6"> <p class="text-danger">' + value + '</p></td></tr>');
				        });
			    	}  
			  })

			 }

		//Process ORDER link click
		$('.order').click(function(event) {
		 	
		    var anchorData = $(this).data('values');
		    var orderUri = '{{ route("order") }}';
		    fetch_data(anchorData, orderUri);

		    event.preventDefault();
		 });

		//Process SEARCH button click
		$('form.search').on('submit', function(event){
		 	
		 	var formData = $(this).serialize();
		 	var searchUri = '{{ route("search") }}';
		 	fetch_data(formData, searchUri); 
		 	
		 	event.preventDefault();
		 });

	});

</script>