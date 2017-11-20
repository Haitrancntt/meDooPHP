<?php
/**
 * Created by PhpStorm.
 * User: haitr
 * Date: 11/21/2017
* Time: 12:20 AM
*/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Medoo\Medoo;

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/selectUser', function (Request $request, Response $response) {
    $database = new Medoo([
        'database_type' => 'sqlite',
        'database_file' => 'vendor/sqlite/trainingDB.db'
    ]);
    $data = $database->select('USER', '*');
    $data = json_encode($data);
    $response->getBody()->write($data);
    return $response;
});

$app->get('/selectUser/{id}', function (Request $request, Response $response) {
    $database = new Medoo([
        'database_type' => 'sqlite',
        'database_file' => 'vendor/sqlite/trainingDB.db'
    ]);
    $id = $request->getAttribute('id');
    $data = $database->select('USER', '*', ['id'=>$id]);
    $data = json_encode($data);

    $response->getBody()->write($data);

    return $response;
});

//$app->get('/insertUser/{id}&{name}&{email}&{age}', function (Request $request, Response $response) {
//    $database = new Medoo([
//        'database_type' => 'sqlite',
//        'database_file' => 'vendor/sqlite/trainingDB.db'
//    ]);
//    $id = $request->getArgument('id');
//    $name = $request->getArgument('name');
//    $email = $request->getArgument('email');
//    $age = $request->getArgument('age');
//
//    $database->insert('USER',
//        [
//            'id'=>$id,
//            'name'=>$name,
//            'email'=>$email,
//            'age'=>$age
//        ]);
//});
//$app->post('/hello', function (Request $request, Response $response) {
//    $data = $request->getParsedBody();
//    $database = new Medoo([
//        'database_type' => 'sqlite',
//        'database_file' => 'vendor/sqlite/trainingDB.db'
//    ]);
//    $database->insert("USER", [
//        "id" => $data["id"],
//        "name" => $data["name"],
//        "email" => $data["email"],
//        "age" => $data["age"],
//    ]);
//    // $response->getBody()->write($data);
//    return $response;
//});
$app->run();


?>