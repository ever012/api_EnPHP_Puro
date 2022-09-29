<?php
echo "HOLA MUNDO";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usando API en PHP PURO</title>

    
</head>
<body>
<?php
    $url = 'https://nodejs-mysql-restapi-test-production-ee31.up.railway.app/';
    
    $curl = curl_init(); //iniciar curl

    curl_setopt($curl, CURLOPT_URL, $url."api/employees");//peticion get 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //especificar que quiero que se retornen los datos en vez de mostrar en pantalla
    $response = curl_exec($curl);
    
    if(curl_errno($curl))
    {
        echo curl_error($curl);
    }else
    {
        $response = json_decode($response, true); //convierto el resultado en un array asociativo
    }

    //var_dump($response);

    curl_close($curl); //cerrar la conexion

    /*$return = file_get_contents("https://nodejs-mysql-restapi-test-production-ee31.up.railway.app/api/employees");
    echo "<script>console.log($return);</script>";*/
?>
    <div class="contenedor1" id="contenedor1">
        <h1>lista de empleados:</h1><br>
        <table>
            <tr>
                <form action="crear.php" method="post">
                    <td>nombre: <input type="text" name="nombre" id="nombre"></td>
                    <td>salario: <input type="text" name="salario" id="salario"></td>
                    <td><button type="submit" id="crear">Agregar Nuevo empleado</button></td>
                </form>
            </tr>
        </table>
        
        <table>
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>salario</th>
                <th>Acciones</th>
            </tr>
            <tbody>
            <?php
            for ($i=0; $i < count($response) ; $i++) { 
                echo '
                <tr>
                    <td id="'.$response[$i]['id'].'">'.$response[$i]['id'].'</td>
                    <td id="'.$response[$i]['id'].'nombre" data-nombre="'.$response[$i]['name'].'">'.$response[$i]['name'].'</td>
                    <td id="'.$response[$i]['id'].'salario" data-salario="'.$response[$i]['salary'].'">'.$response[$i]['salary'].'</td>
                    <td id="'.$response[$i]['id'].'botones"><button id="'.$response[$i]['id'].'actualizar" onclick="modParaActualizar('.$response[$i]['id'].')">Actualizar</button><button id="'.$response[$i]['id'].'eliminar" onclick="deleted('.$response[$i]['id'].')">Eliminar</button></td>
                </tr>
            ';
            }
            ?>
            

            </tbody>
            <br>
           
        </table>
    </div>
    <script>
        function modParaActualizar(id)
        {
            let nombre = document.getElementById(id + "nombre");
            let salario = document.getElementById(id + "salario");
            let btnactualizar = document.getElementById(id + "actualizar");
            
            nombre.innerHTML = '<input type="text" name="'+id+'name" id="'+id+'name" value='+nombre.dataset.nombre+'>';
            salario.innerHTML = '<input type="text" name="'+id+'salary" id="'+id+'salary" value='+salario.dataset.salario+'>';
            btnactualizar.setAttribute('onclick', "actualizar("+id+")");
            
        }

        function actualizar(id)
         {
            let nombre = document.getElementById(id + "name");
            let salario = document.getElementById(id + "salary");
            window.location.href = "actualizar.php/?id="+id+"&name="+nombre.value+"&salary="+salario.value;
         }

         function deleted(id)
         {
            window.location.href = "eliminar.php/?id="+id;
         }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</body>
</html>