<html>
    <head>
        <title>Carrito de compras</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php
                echo "<h1>Carrito de compras</h1>";

                if(!isset($_ENV['DB_HOST']))
                  $host = 'localhost:3306';
                else $host = $_ENV['DB_HOST'].':3306';

                if(!isset($_ENV['DB_PASSWORD'])) 
                  $password = '';
                else $password = $_ENV['DB_PASSWORD'];

                $conn = mysqli_connect($host, 'root', $password, "tienda_dulces");

                $query = 'SELECT * From carrito_compras';
                $result = mysqli_query($conn, $query);

                echo '<table class="table table-striped">';
                echo '<thead><tr><th></th><th>Clave usuario</th><th>Clave producto</th><th>Cantidad producto</th></tr></thead>';
                while($value = $result->fetch_array(MYSQLI_ASSOC)){
                    echo '<tr>';
                    echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
                    foreach($value as $element){
                        echo '<td>' . $element . '</td>';
                    }

                    echo '</tr>';
                }
                echo '</table>';

                $result->close();
                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
