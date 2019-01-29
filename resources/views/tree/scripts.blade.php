  <script>
    $(function() {
      $('#container').jstree({
        'core' : {
          'data' : {
            "url" : "{{ url('/tree') }}",
            "dataType" : "json" 
          }
        }
      });
    });
  </script>