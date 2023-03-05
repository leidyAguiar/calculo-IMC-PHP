<?php

session_start();

require_once("conexaoBanco.php");

if (isset($_POST['btnCalcular'])) {
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $resultado_imc = $peso / ($altura * $altura);
    $resultado_imc = number_format($resultado_imc, 2, '.', '');
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $contato = $_POST['contato'];
    $data = $_POST['data'];
    $calculado = true;
    $_SESSION['resultado_imc'] = $resultado_imc;
    $_SESSION['calculado'] = $calculado;

    $mysql_query = "INSERT INTO pacientes (NOME, CPF, CONTATO_PACIENTE, ALTURA, PESO, RESULTADO_IMC, DATA_COLETA) VALUES ('$nome', '$cpf', '$contato', '$altura', '$peso', '$resultado_imc', '$data')";
    $result = mysqli_query($conn, $mysql_query);
    if (!$result) {
        die("Failed to insert data into MySQL: " . mysqli_error($conn));
    }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
    <style>
        body{
            background-color: #e9ecef;
            height: 50px;
            min-width: 90%;
            text-align: center;
            font-size: 18pt;
            padding: 10px;
        }
    </style>

    <div class="container col-sm-6 d-flex flex-column justify-content-center vh-100">
        <div class="row content">
            <div class="row">
                <div class="col">
                    <table class="table" id="Tabela">
                        <thead>
                            <tr class="center">
                                <th scope="col" colspan="3" class="center"> VEJA A INTERPRETAÇÃO DO IMC</th>
                            </tr>
                            <tr>
                                <th scope="col">IMC</th>
                                <th scope="col">CLASSIFICAÇÃO</th>
                                <th scope="col">OBESIDADE (GRAU)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="
                                <?php if ($calculado && $resultado_imc < 18.5) {
                                    echo "table-success";
                                }
                                ?>
                                    ">
                                <td>MENOR QUE 18,5 </td>
                                <td>MAGREZA</td>
                                <td>0</td>
                            </tr>
                            <tr class="
                                <?php if ($calculado && $resultado_imc >= 18.5 && $resultado_imc <= 24.9) {
                                    echo "table-success";
                                }
                                ?>
                                    ">
                                <td>ENTRE 18,5 E 24,9 </td>
                                <td>NORMAL</td>
                                <td>0</td>
                            </tr>
                            <tr class="
                                <?php if ($calculado && $resultado_imc >= 25 && $resultado_imc <= 29.9) {
                                    echo "table-success";
                                }
                                ?>
                                    ">
                                <td>ENTRE 25,0 E 29,9 </td>
                                <td>SOBREPESO</td>
                                <td>I</td>
                            </tr>
                            <tr class="
                                <?php if ($calculado && $resultado_imc >= 30 && $resultado_imc <= 39.9) {
                                    echo "table-success";
                                }
                                ?>
                                    ">
                                <td>ENTRE 30,0 E 39,9 </td>
                                <td>OBESIDADE</td>
                                <td>II</td>
                            </tr>
                            <tr class="
                                <?php if ($calculado && $resultado_imc >= 40) {
                                    echo "table-success";
                                }
                                ?>
                                    ">
                                <td>MAIOR QUE 40,0 </td>
                                <td>OBESIDADE GRAVE </td>
                                <td>III</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if (isset($resultado_imc)) { ?>

                <div class="col-sm-3">
                    <div class= "alert alert-success" role="alert" >
                        <strong>SEU IMC: <?php echo $resultado_imc; ?></strong>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2023 Leidiane Cunha de Aguiar</p>
        <p class="mb-1">® Todos os direitos reservados</p>
    </footer>
    </div>
</body>
</html>