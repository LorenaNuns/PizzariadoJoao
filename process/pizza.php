<?php

    include_once("conn.php");
    $method = $_SERVER["REQUEST_METHOD"];

    //Resgate dos dados no Banco, ou seja, montagem do pedido
    // Get informações para montar a pizza no Banco
    if ($method === "GET") {

        //Conectando com o banco e Utilizando comandos de SQL para puxar informações
        $bordasQuery = $conn->query("SELECT * FROM bordas;");

        //Executando a query e colocando os valores dentro de uma array, através do fetchAll
        $bordas = $bordasQuery->fetchAll();

        $massasQuery = $conn->query("SELECT * FROM massas;");

        $massas = $massasQuery->fetchAll();

        $saboresQuery = $conn->query("SELECT * FROM sabores;");

        $sabores = $saboresQuery->fetchAll();

    // Criação do pedido
    //Post = informações enviadas para o Banco de Dados
    } else if ($method === "POST") {
        $data = $_POST;

        $borda = $data["borda"];
        $massa = $data["massa"];
        $sabores = $data["sabores"];

        //Validação de sabores máximos
        if (count($sabores) > 3) {

            $_SESSION["msg"] = "Selecione no máximo 3 sabores!";
            $_SESSION["status"] = "warning";

        } else {
            //Salvando borda e massa na pizza
            //Utiliza prepare para dados de fora do banco que serão inseridos
            $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");

            //Filtranso inputs
            //Bind está likando o campo do BD com o valor da variável da aplicação
            $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
            $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

            $stmt->execute();

            //Resgatando último id da última pizza
            $pizzaId = $conn->lastInsertId();

            $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");

            //Repetição até terminar de salvar todos os sabores

            foreach($sabores as $sabor) {

                //Filtrando os inputs
                $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
                $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);


                $stmt->execute();
            }

            //Criar pedido da Pizza

            $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)");

            //Status sempre inicia com 1, ou seja, status de produção
            $statusId = 1;

            //Filtrar input
            $stmt->bindParam(":pizza", $pizzaId);
            $stmt->bindParam(":status", $statusId); 

            $stmt->execute();

            //Exibir mensagem de sucesso
            $_SESSION["msg"] = "Pedido realizado com sucesso";
            $_SESSION["status"] = "sucess";

        }

        //Retorna para a página inicial
        header("Location: ..");
    }
?>