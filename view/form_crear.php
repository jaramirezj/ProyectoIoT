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
      <link type="text/css" href="..\css\estilos" rel="stylesheet" media="all" >

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
        <a href="../controller/main.php?action=users">
          <button type="button" class="btn btn-outline-light btn-lg navbar-btn">Regresar</button>
        </a>
      </div>
    </nav><br><br><br>
    <div class="container container-fluid">
        <div class="alert alert-secondary form-control text-center formulario">
            <h2>Crear un nuevo usuario</h2>
            <form action="../controller/main.php?user=create" method="post">
                <input type="text" name="id" placeholder="Identificación usuario" class="form-control-lg"/>
                <input type="text" name="idtarjeta" placeholder="Id Tarjeta RFID" class="form-control-lg"/>
                <input type="text" name="nombres" placeholder="Nombre y apellidos" class="form-control-lg"/>
                <input type="text" name="pass" placeholder="Contraseña" class="form-control-lg"/>
                <input type="submit" value="Enviar" class="btn btn-primary btn-lg"/>
            </form>
        </div>
    </div>
  </body>
</html>