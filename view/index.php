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

     <!--Conexion con estilos.css-->
     <link type="text/css" href="..\css\estilos.css" rel="stylesheet" media="all" >

  </head>
  <body>
    <nav class="navbar navbar-inverse bg-primary">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand text-light"><br><h3> Access Control System </h3></a>
        </div>
        <a href="../controller/main.php?action=users">
          <button type="button" class="btn btn-outline-light btn-lg navbar-btn">Gestionar Usuarios</button>
        </a>
      </div>
    </nav>
    <div class="container container-fluid contenedor">
      <div class="row">
        <div class="col-sm-8">
          <div class="info">
            <div class="titulo">
              <h2>Bienvenido al panel de administración para el Sistema de control de acceso</h2>
            </div><br>
            <p><h3>Aquí podrás:</h3></p>
            <div class="text-justify texto_info">
              <h5>- Visualizar la cantidad de vehiculos/personas actualmente.<br>
              <br>- Permitir el acceso a nuevos usuarios.<br>
              <br>- Modificar datos de los usuarios actuales.</h5>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="text-center text-secondary">
            <h3>Cantidad actual de personas: <?php echo $data['actual']; ?></h3>
          </div>
          <div class="alert alert-primary">
            <h5>Maximo actual permitido : <?php echo $data['maximo']; ?></h5>
            <form action="../controller/main.php?action=max" method="post" class="form-control text-center">
              <input type="number" name="maximo" class="form-control-lg" placeholder="Modificar máximo"/><br><br>
              <button type="submit" name="boton" class="btn btn-primary btn-lg">Guardar</button>
            </form>
          </div><br><br>
          <div class="text-center text-success">
            <h4>
              Estado actual del acceso:
              <?php if($data['estado']==1){echo "Activo";
              }else if($data['estado']==2){
                echo "Bloqueado";
              }else if($data['estado']==3){echo "Acceso libre";}?> 
            </h4><br>
              
              <?php if(!($data['estado']==1)){ ?>
              <a href="../controller/main.php?action=state&s=1" class="boton">
                <button type="button" class="btn btn-success">
                 <h3>Activar</h3>
                </button>
              </a><?php } ?>
              <?php if(!($data['estado']==2)){ ?>
              <a href="../controller/main.php?action=state&s=2" class="boton">
                <button type="button" class="btn btn-danger">
                 <h3>Bloquear acceso</h3>
                </button>
              </a><?php } ?>
              <?php if(!($data['estado']==3)){ ?>
              <a href="../controller/main.php?action=state&s=3">
                <button type="button" class="btn btn-warning">
                  <h3>Acceso libre</h3>
                </button>
              </a><?php } ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>