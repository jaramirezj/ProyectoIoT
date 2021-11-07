<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
     <meta charset="utf-8">
     <title>Access Control</title>

      <!--Links css de bootstrap-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
     rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
     crossorigin="anonymous">

     <!--Links js de bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
       integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" 
      integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

     <!--Conexion con estilos.css-->
      <link type="text/css" href="..\css\estilos.css" rel="stylesheet" media="all" >

      <!--Conexion con datatables js-->
          <link rel="stylesheet" type="text/css" 
          href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
          <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" 
          type="text/javascript"></script>

  </head>
  <body>
    <nav class="navbar navbar-inverse bg-primary">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand text-light"><br><h3> Gestión de Usuarios </h3></a>
        </div>
        <a href="../controller/main.php">
          <button type="button" class="btn btn-outline-light btn-lg navbar-btn">Regresar</button>
        </a>
      </div>
    </nav>
    <div class="container container-fluid">
        <br>
         <a href="../controller/main.php?user=create_screen" class="btn btn-success">Crear nuevo usuario</a>
        <table id="tabla" class="table table-secondary table-hover">
             <thead class="thead thead-dark thead-hover">
                 <tr style="">
                     <th style="text-align: left;">Identificador</th>
                     <th style="text-align: left;"> Id Tarjeta</th>
                     <th style="text-align: left;">Nombre y apellidos</th>
                     <th style="text-align: left;">Estado actual</th>
                     <th style="text-align: left;">Registrado</th>
                     <th style="text-align: left;">Operaciones</th>
                  </tr>
             </thead>
             <tbody>
                  <?php
                    foreach($data as $usuarios){
                   ?>
                       <tr>
                           <td><?php echo $usuarios['idusuario'];?></td>
                           <td><?php echo $usuarios['idrfid'];  ?> </td>
                           <td><?php echo $usuarios['nombre_apellidos'];?> </td>
                           <td><?php if($usuarios['estado_actual']==0){
                               echo "Fuera del parqueadero";
                                     }else{
                                         echo "En el parqueadero";
                                     } ?> </td>
                           <td><?php echo  $usuarios['registrado']; ?> </td>
                           <td>
                               <a href="../controller/main.php?user=delete&id=<?php echo $usuarios['idusuario']; ?>" class="btn btn-danger">
                                     Eliminar
                                </a>
                           </td>
                       </tr>
                 <?php
                     }
                  ?>
             </tbody>
          </table>
     </div>
    
      <!-- jQuery -->
      <script language="javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
     <!-- JavaScript DataTables -->
     <script language="javascript" type="text/javascript" 
     src="https://cdn.datatables.net/v/dt/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
     <!--DataTables JS--> 
     <script language="javascript" type="text/javascript"  src="../js/table.js"></script>
  </body>
</html>