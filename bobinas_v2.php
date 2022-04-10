<!DOCTYPE html>
<html>
  <head>
    <title>Remisiones</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <br />
    <div class="container">
      <h3 align="center">Buscar Boinas</h3>
      <br />
      <div class="card">
        <div class="card-header">
            Lista Remisiones
            <a class="float-right" href="/bobinas_v2">  Bobinas</a><a class="float-right" href="/menuprincipal.php">Inicio / </a>

        </div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="ID Remision" />
          </div>
          <div class="table-responsive" id="dynamic_content">
            
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){

    load_data(1,'B');

    function load_data(page,tipo='B',query = '')
    {
      $.ajax({
        url:"remisionesPost_b.php",
        method:"POST",
        data:{page:page, tipo:tipo,query:quer},

        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page,"B",query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, "B",query);
    });

    //cuando de clic en eliminar
   
    $("#dynamic_content").on("click", ".delete", function(e) {
        let valor = $(this).attr('data-id');
        console.log({valor:valor});
        //mensajito
        Swal.fire({
            title: 'Eliminar?',
            text: "Seguro que deseas eliminar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: "POST",
                    url: "deleteremision.php",
                    data: {id:valor},
                    success: function(response) {	
                        console.log(response);		
                        Swal.fire(
                            'Eliminado',
                            'Registro Eliminado',
                            'success'
                        ) 
                    }
                });


                
            }
        })
    });
    

  });
</script>