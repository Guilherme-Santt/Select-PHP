<?php
include('conexao.php');
$sql_code = "SELECT * FROM estados ORDER BY nome ASC";
$query = $mysqli->query($sql_code) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <select name="estado" required>
            <option value="">Selecione um estado</option>
            <?php while($estado = $query->fetch_assoc()){?>
            <option 
            <?php if(isset($_GET['estado']) && ($_GET['estado']) == $estado['id']) echo "selected"  ?>
            value="<?php echo $estado['id']?>"><?php echo $estado['nome']?></option>
            <?php } ?>
        </select>

        
        <?php if(isset($_GET['estado'])){ ?>
        <select required name="cidade">
            <option value=""></option>
            <?php 
            $select_state = $mysqli->real_escape_string($_GET['estado']);
            $sql_code_cities = "SELECT * FROM cidades where id_estado = '$select_state' ORDER BY nome ASC";
            $query_cities = $mysqli->query($sql_code_cities) or die($mysqli->error);

            while($cidade = $query_cities->fetch_assoc() ){ ?>
                <option value="<?php echo $cidade['id']; ?>"> <?php echo $cidade['nome'];?> </option>
            <?php } ?>
        </select>
        <?php } ?>

        <button type="submit">Avançar</button>
    </form>
</body>
</html>