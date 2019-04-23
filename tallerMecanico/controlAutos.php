<?php
   require ('php/conexion/conexion.php');
    $id = $_GET["id"];

   $where="";
   
   $sql = "SELECT * FROM automovil WHERE id_cliente=".$id;
   
   $resultado = mysqli_query($conexion, $sql);
   
   ?>
<!doctype html>
<html lang="es">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.css">
      <!--stilos personalizados de css-->
      <title>Control de automoviles</title>
   </head>
   <body>
      <!-- Div contendor de toda la pagina Web -->
      <div id="contenedor">
         <!-- Div contendor del header -->
         <div id="header">
            <div id="presentacion">
               <img src="imagenes/cabeza/nav4.png" width="100%">
            </div>
            <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark sticky-top">
               <a class="navbar-brand" href="">
               <img src="imagenes/logo/logoTaller.png" width="60" height="30" class="d-inline-block align-top" alt=" ">
               Taller mecanico
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class=" ml-auto collapse navbar-collapse" id="navbarNavDropdown">
                  <div class="ml-auto">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="control.php?id=<?php echo $_GET['idA']?>">Cliente</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="php/sesion/cerrarSesion.php">Cerrar Sesion</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <?php
               session_start();
                       
               
               if(isset($_SESSION['usuario'])){               
               }else{
                   header("Location:iniciarSesion.php");
               }
               
               ?>
            <div id="contenido">
               <div class="container">
                  <div class="row">
                     <h2>Control de automoviles</h2>
                  </div>
                  <div class="row">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                     Nuevo
                     </button>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Crear cliente</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form method="post" action="php/crudeAuto/creaAuto.php">
                                    <div class="form-row">
                                       <div class="form-group col-md-6">
                                          <label for="inputEmail4">Matricula</label>
                                          <input class="form-control" placeholder="Matricula" name="matricula">
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label for="inputPassword4">Marca</label>
                                          <input class="form-control" placeholder="Marca" name="marca">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputAddress">Modelo</label>
                                       <input type="text" class="form-control" placeholder="Modelo" name="modelo">
                                    </div>
                                    <div class="form-group">
                                       <label for="inputAddress">Linea</label>
                                       <input type="text" class="form-control" placeholder="Linea" name="linea">
                                    </div>
                                    <div class="form-group">
                                       <label for="inputAddress2">Color</label>
                                       <input type="text" class="form-control" placeholder="Color" name="color">
                                    </div>
                                    <div>
                                       <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                                    </div>
                                    <div>
                                       <input type='hidden' name='idA' value='<?php echo $_GET['idA']?>'>
                                    </div>
                                    <div>
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                       <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>Matricula</th>
                              <th>Marca</th>
                              <th>Modelo</th>
                              <th>Linea</th>
                              <th>Color</th>
                              <th></th>
                              <th></th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php while($row = mysqli_fetch_array($resultado)){
                              ?>
                           <tr>
                              <td>
                                 <?php echo $row['Matricula']?>
                              </td>
                              <td>
                                 <?php echo $row['Marca']?>
                              </td>
                              <td>
                                 <?php echo $row['Modelo']?>
                              </td>
                              <td>
                                 <?php echo $row['Linea']?>
                              </td>
                              <td>
                                 <?php echo $row['Color']?>
                              </td>
                              <td>
                                 <a href="actualizarAutos.php?M=<?php echo $row['Matricula']?>&idC=<?php echo $row['id_cliente']?>&idA=<?php echo $row['id_administrador']?>">
                                 <button type="button" class="btn btn-dark">M</button>
                                 </a>
                              </td>
                              <td>
                                 <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#eliminar">E</button>
                              </td>
                              <div class="modal" tabindex="-1" role="dialog" id="eliminar">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Eliminar</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p>¿Seguro que desea eliminar este usuario?</p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-dark" >
                                          <a onClick="return eliminar(<?php echo $row['Matricula'];?>);" style="text-decoration: none" href="php/crudeAuto/eliminarAuto.php?M=<?php echo $row['Matricula']?>&idC=<?php echo $row['id_cliente']?>&idA=<?php echo $row['id_administrador']?>">Eliminar
                                          </a>
                                          </button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <td>
                                 <a href="controlReparacion.php?M=<?php echo $row['Matricula']?>&id=<?php echo $row['id_cliente']?>&idA=<?php echo $row['id_administrador']?>">
                                 <button type="button" class="btn btn-success">Reparacion</button>
                                 </a>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="js/bootstrap.js" ></script>
   </body>
</html>