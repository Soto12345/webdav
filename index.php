<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Importando las librerias de boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>WebDAV</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.php">
		 <img src="./img/logo.png" alt="" width="30px">           
		 <span class="text-uppercase fw-lighter ms-2">Tecno-Total</span>
        </a> 
    </div>
</nav>
</header>
<br>
<br>
<br>
<br>
    <div class="container mt-4">
        <h1 class="mt-4">Contenido de WebDAV</h1>
        <div class="mt-4">
            <?php
            // Supongamos que obtienes el nombre de usuario de alguna forma
            $username = $_SERVER['PHP_AUTH_USER']; // Nombre de usuario obtenido después de la autenticación

            // Directorio base donde se encuentran los directorios de cada usuario
            $baseDirectory = '/var/www/webdav/pdfs';

            // Si el usuario es 'administrador@gmail.com', mostrar todos los directorios y archivos
            if ($username == 'administrador@gmail.com') {
                $userDirectories = glob($baseDirectory . '/*', GLOB_ONLYDIR);
                foreach ($userDirectories as $userDirectory) {
                    // Obtener el nombre del directorio
                    $dirname = basename($userDirectory);

                    // Mostrar el nombre del directorio del usuario
                    echo '<h3>' . $dirname . '</h3>';

                    // Obtener listado de archivos y directorios del usuario
                    $files = scandir($userDirectory);

                    // Mostrar los archivos y directorios del usuario en una tabla
                    echo '<table class="table">';
                    echo '<thead><tr><th>Nombre</th><th>Tipo</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($files as $file) {
                        // Omitir los archivos "." y ".."
                        if ($file != '.' && $file != '..') {
                            // Determinar si es un archivo o un directorio
                            $type = is_dir($userDirectory . '/' . $file) ? 'Directorio' : 'Archivo';

                            // Construir la URL correcta para el archivo o directorio
                            $url = ($type == 'Archivo') ? 'http://www.webdavtecno.com/pdfs/' . $dirname . '/' . $file : '';

                            // Mostrar el nombre del archivo o directorio en la tabla
                            echo '<tr><td><a href="' . $url . '">' . $file . '</a></td><td>' . $type . '</td></tr>';
                        }
                    }
                    echo '</tbody></table>';
                }
            } else {
                // Si el usuario no es 'administrador@gmail.com', mostrar solo su directorio
                $userDirectory = $baseDirectory . '/' . $username;

                // Verificar si el directorio del usuario existe
                if (is_dir($userDirectory)) {
                    // Obtener listado de archivos y directorios del usuario
                    $files = scandir($userDirectory);

                    // Mostrar el nombre del directorio del usuario
                    echo '<h3>' . $username . '</h3>';

                    // Mostrar los archivos y directorios del usuario en una tabla
                    echo '<table class="table">';
                    echo '<thead><tr><th>Nombre</th><th>Tipo</th></tr></thead>';
                    echo '<tbody>';
                    foreach ($files as $file) {
                        // Omitir los archivos "." y ".."
                        if ($file != '.' && $file != '..') {
                            // Determinar si es un archivo o un directorio
                            $type = is_dir($userDirectory . '/' . $file) ? 'Directorio' : 'Archivo';

                            // Construir la URL correcta para el archivo o directorio
                            $url = ($type == 'Archivo') ? 'http://www.webdavtecno.com/pdfs/' . $username . '/' . $file : '';

                            // Mostrar el nombre del archivo o directorio en la tabla
                            echo '<tr><td><a href="' . $url . '">' . $file . '</a></td><td>' . $type . '</td></tr>';
                        }
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>No se encontró el directorio del usuario.</p>';
                }
            }
            ?>
        </div>
    </div>
    <!-- Enlazar Bootstrap JavaScript (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
