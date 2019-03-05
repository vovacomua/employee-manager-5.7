  <script>
    $(function() {
      $('#container').jstree({
        'core' : {
          'data' : {
            "url" : "{{ url('/tree/?lazy') }}",
            "data" : function (node) {
              return { "id" : node.id };
            }
          }
        }
      });
    });
  </script>