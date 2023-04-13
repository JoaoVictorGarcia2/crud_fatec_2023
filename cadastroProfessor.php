<?php
header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20421067_cebulo", "id20421067_joaovictor", "]lHN#ivf0DjFu_EE");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT * FROM FATEC_PROFESSORES 
 ORDER BY id DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $data = array(
        ':Nome' => $received_data->Nome,
        ':Endereco' => $received_data->Endereco,
        ':Curso' => $received_data->Curso,
        ':Salario' => $received_data->Salario
    );

    $query = "
 INSERT INTO FATEC_PROFESSORES  
 (Nome, Endereco, Curso, Salario) 
 VALUES (:Nome, :Endereco, :Curso, :Salario)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Adicionado'
    );

    echo json_encode($output);
}
if ($received_data->action == 'fetchSingle') {
    $query = "
 SELECT * FROM FATEC_PROFESSORES 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data['id'] = $row['id'];
        $data['Nome'] = $row['Nome'];
        $data['Endereco'] = $row['Endereco'];
        $data['Curso'] = $row['Curso'];
        $data['Salario'] = $row['Salario'];
    }

    echo json_encode($data);
}
if ($received_data->action == 'update') {
    $data = array(
        ':Nome' => $received_data->Nome,
        ':Endereco' => $received_data->Endereco,
        ':Curso' => $received_data->Curso,
        ':Salario' => $received_data->Salario,
        ':id' => $received_data->hiddenId
    );

    $query = "
 UPDATE FATEC_PROFESSORES  
 SET Nome = :Nome, 
 Endereco = :Endereco,
 Curso = :Curso ,
 Salario = :Salario
 WHERE id = :id
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Atualizado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'delete') {
    $query = "
 DELETE FROM FATEC_PROFESSORES  
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Professor Deletado'
    );

    echo json_encode($output);
}

?>