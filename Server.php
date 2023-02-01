<?php
function addCar($car) {
    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=cars', 'root');

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO cars (brand, mileage, price, color) VALUES (:brand, :mileage, :price, :color)");

    // Bind the values
    $stmt->bindValue(':brand', $car->brand);
    $stmt->bindValue(':mileage', $car->mileage);
    $stmt->bindValue(':price', $car->price);
    $stmt->bindValue(':color', $car->color);

    // Execute the statement
    $stmt->execute();

    // Close the connection
    $db = null;

    return true;
}

function modifyCar($brand, $mileage, $price, $color) {
    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=cars', 'root');

    // Prepare the SQL statement
    $stmt = $db->prepare("UPDATE cars SET mileage = :mileage, price = :price, color = :color WHERE brand = :brand");

    // Bind the values
    $stmt->bindValue(':brand', $brand);
    $stmt->bindValue(':mileage', $mileage);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':color', $color);

    // Execute the statement
    $stmt->execute();

    // Close the connection
    $db = null;

    return selectCar($brand);
}

function deleteCar($car) {
    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=cars', 'root');

    // Prepare the SQL statement
    $stmt = $db->prepare("DELETE FROM cars WHERE brand = :brand");

    // Bind the values
    $stmt->bindValue(':brand', $car->brand);

    // Execute the statement
    $result = $stmt->execute();

    // Close the connection
    $db = null;

    return $result;
}

function selectCar($brand) {
    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=cars', 'root');

    // Prepare the SQL statement
    $stmt = $db->prepare("SELECT * FROM cars WHERE brand = :brand");

    // Bind the values
    $stmt->bindValue(':brand', $brand);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $car = $stmt->fetch(PDO::FETCH_OBJ);

    // Close the connection
    $db = null;

    return $car;
}

$server = new SoapServer("project.wsdl");
$server->addFunction("addCar");
$server->addFunction("modifyCar");
$server->addFunction("deleteCar");
$server->addFunction("selectCar");
$server->handle();