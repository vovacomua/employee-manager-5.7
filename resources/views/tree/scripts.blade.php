<script>
  function fetch_data(query, uri){
  $.ajax({
     url:uri,
     method:'GET',
     data:query,
     dataType:'json',
     success:function(data)
       {
        console.log(data);
        if (data['status'] == 'error'){
          alert(data['message']);
        }
       },
      error: function (data) {
          var errors = $.parseJSON(data.responseText);
          $.each(errors, function (key, value) {
              console.log(value);
          });
      }  
    })

   }

  $(function() {

    $('#container').jstree({
      "core" : {
      "animation" : 0,
      "check_callback" :  function (op, node, par, pos, more) {
          if ((op === "move_node" || op === "copy_node") && node.type && node.type == "root") {
          return false;
        }
          if ((op === "move_node" || op === "copy_node") && more && more.core && !confirm('Are you sure you want to set a new boss for this employee?')) {
          return false;
        }
        return true;
      },
      "data" : {
          "url" : "{{ url('/tree/?lazy') }}",
          "data" : function (node) {
            return { "id" : node.id };
          }
        }
      },

      "plugins" : [ "dnd" ]
    });

    $("#container").bind('move_node.jstree', function(e, data) {
        rebaseUri = '{{ url("treerebase") }}';
        query = 'id=' + data.node.id + '&parent_id=' + data.parent;
        fetch_data(query, rebaseUri);
    });

  });
</script>
