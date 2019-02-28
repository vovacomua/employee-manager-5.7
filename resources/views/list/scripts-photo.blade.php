    <script type="text/javascript">

    if (window.FileReader) {
      
        document.getElementById('photo').addEventListener('change', handleFileSelect, false);

        function handleFileSelect(evt) {
            var files = evt.target.files;
            var f = files[0];
            var reader = new FileReader();
             
              reader.onload = (function(theFile) {
                    return function(e) {
                      document.getElementById('photo-preview').innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" style="max-height:150px" />'].join('');
                    };
              })(f);
               
              reader.readAsDataURL(f);
      }

    } else {
      alert('This browser does not support FileReader');
    }

  </script>