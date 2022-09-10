<!doctype html>
<html lang="en">

<head>
  <title>CRUD PHP</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body style="background-color: rgb(191, 209, 219);">
    <header>
    <div class="collapse" id="navbarToggleExternalContent">
  <div class="p-4" style="background-color: rgb(114, 152, 146); color: white;">
    <a href="index.php" style="text-decoration: none; color: white;">Crud_Php</a>
    <a href="nosotros.php" style="text-decoration: none;color: white;">Nosotros</a>
    <a href="https://github.com/blitxs1226" style="text-decoration: none;color: white;">github</a>
  </div>
</div>
<nav class="navbar  " style="background-color: rgb(114, 152, 146); color: white;">
  <div class="container-fluid" style="background-color: rgb(114, 152, 146); color: white;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
    </header>
    
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <div class="container">
    <form class="d-flex" action="crud_estudiantes.php" method="post">
        <div class="col">

        <div class="mb-3">
                <label for="txt_id" class="form-label">Id</label>
                <input type="text" name="txt_id" id="txt_id" class="form-control" placeholder="0" readonly>
            </div>

            <div class="mb-3">
                <label for="txt_carne" class="form-label">Codigo</label>
                <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="E001" onchange="carnetValidacion(this);" require>
            </div>

            <div class="mb-3">
                <label for="txt_nombres" class="form-label">Nombres</label>
                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Luis Jose" require>
            </div>

            <div class="mb-3">
                <label for="txt_apellidos" class="form-label">Apellidos</label>
                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Mendez Orduz" require>
            </div>

            <div class="mb-3">
                <label for="txt_direccion" class="form-label">Direccion</label>
                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="5ta calle oriente" require>
            </div>
            
            <div class="mb-3">
                <label for="txt_telefono" class="form-label">Telefono</label>
                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="00000000" require>
            </div>


            <div class="mb-3">
                <label for="txt_correo" class="form-label">correo</label>
                <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="x@mail.com" require>
            </div>


            <div class="mb-3">
              <label for="lbl_sangre" class="form-label">Tipo Sangre</label>
              <select class="form-control" name="drop_sangre" id="drop_sangre">
                <option value=0>-----sangre-----</option>

                <?php 
                
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
                $db_conexion ->real_query("select id_tipos_sangre as id,sangre from tipos_sangre;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {

            
                    echo"<option value=".$fila['id'].">". $fila['sangre']. "</option>";


                }
                $db_conexion ->close();
                ?>
                
              </select>
            </div>
            
            <div class="mb-3">
                <label for="txt_fn" class="form-label">fecha de nacimiento</label>
                <input type="date" name="txt_fn" id="txt_fn" class="form-control" require>
            </div>
            
            <div class="mb-3">
                
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="agregar" require>
                <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value="modificar" require>
                <input type="submit" class="btn btn-danger" id="btn_eliminar"  name="btn_eliminar" 
                 onclick="javascript:if(!confirm('Desea Eliminar Este Estudiante?')) return false " value="eliminar" require>
            
            </div>

        </div>
    </form>
            </div> 



      </div>
      
    </div>
  </div>
</div>








    
<div class="container" style="justify-content: center;align-items: center;">
<div class="d-grid gap-3 my-5" style="justify-content: center;align-items: center;text-align:center">
<button type="button" class="btn btn-secondary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="limpiarForms();">
  Agregar
</button>
</div>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <h4>Estudiantes</h4>
                <tr>
                    <th>carne</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Sangre</th>
                    <th>nacimiento</th>
                </tr>
                </thead>
                <tbody class="table-group-divider" id="tbl_empleados">

                <?php 
                
                include("datos_conexion.php");
                $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
                $db_conexion ->real_query("select e.id_estudiante as id, e.carne,e.nombres, e.apellidos, e.direccion, e.telefono, e.correo_electronico, s.sangre,e.fecha_nacimiento, s.id_tipos_sangre from estudiantes as e inner join tipos_sangre as s on e.id_tipo_sangre = s.id_tipos_sangre;");
                $resultado = $db_conexion->use_result();
                while ($fila = $resultado->fetch_assoc()) {
 
            
                    echo"<tr data-id=".$fila['id']." data-ids=".$fila['id_tipos_sangre'].">";

                    echo"<td>".$fila['carne']."</td>";
                    echo"<td>".$fila['nombres']."</td>";
                    echo"<td>".$fila['apellidos']."</td>";
                    echo"<td>".$fila['direccion']."</td>";
                    echo"<td>".$fila['telefono']."</td>";
                    echo"<td>".$fila['correo_electronico']."</td>";
                    echo"<td>".$fila['sangre']."</td>";
                    echo"<td>".$fila['fecha_nacimiento']."</td>";

                    echo"</tr>";



                }
                $db_conexion ->close();
                ?>

                
                    
                
                


                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
 </div> 
    


 
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>

  <script>
    $("#tbl_empleados").on('click','tr td',function (e) { 
        
        var target,id,ids,carne,nombres,apellidos,direccion,telefono,correo,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        ids = target.parent().data('ids');
        carne = target.parent('tr').find("td").eq(0).html();
        nombres = target.parent('tr').find("td").eq(1).html();
        apellidos = target.parent('tr').find("td").eq(2).html();
        direccion = target.parent('tr').find("td").eq(3).html();
        telefono = target.parent('tr').find("td").eq(4).html();
        correo = target.parent('tr').find("td").eq(5).html();
        nacimiento = target.parent('tr').find("td").eq(7).html();

        $("#txt_id").val(id);
        $("#txt_carne").val(carne);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_correo").val(correo);
        $("#drop_sangre").val(ids);
        $("#txt_fn").val(nacimiento);
        $("#exampleModal").modal("show");
        
        
    });
  </script>
  <script type="text/javascript">
    function limpiarForms(){
      $('#txt_id').val(0);
      $("#drop_sangre").val(0);
      $("#txt_carne").val("");
      $("#txt_nombres").val("");
      $("#txt_apellidos").val("");
      $("#txt_direccion").val("");
      $("#txt_telefono").val("");
      $("#txt_correo").val("");
      $("#txt_fn").val("");
    }
    function carnetValidacion(text) {
      const pattern = /(^E{1})([0-9]{3})$/;
      if (!pattern.test(text.value)) {
        text.setCustomValidity
          ('Ingrese un carnet Valido: E001-E999');
      }else {
        text.setCustomValidity('');
    }
    return true;
    }
    </script>



<footer class="footer mt-auto py-3 "style="background: rgb(114, 152, 146); color: white;">
  
    <div class="container">
      <footer class="py-5">
        <div class="row">
            
    
        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
          <p>&copy; 2022 Company, Inc. All rights reserved.</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
          </ul>
        </div>
      </footer>
    </div>
</footer>
</body>

</html>