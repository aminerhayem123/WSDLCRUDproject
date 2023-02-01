<?php
// Create a new SOAP client

$client = new SoapClient("http://localhost/SOAP/server.php?wsdl");

// Define a new car object
$car = new stdClass();
$car->brand = "BMW";
$car->mileage = "25000";
$car->price = "50000";
$car->color = "red";

// Add the new car to the database
$result =$client->addCar($car);
if ($result) {
    echo "Car added successfully!\n";
} else {
    echo "Error adding car.\n";
}

// Modify the mileage, price, and color of the car
$v = new stdClass();
$v->brand = "BMW";
$v->mileage = "30000";
$v->price = "55000";
$v->color = "blue";
$result=$client->modifyCar($v);
if ($result) {
    echo "Car Modified successfully!\n";
} else {
    echo "Error Modified car.\n";
}

// Delete the car from the database
$result=$client->deleteCar($car);
if ($result) {
    echo "Car Deleted successfully!\n";
} else {
    echo "Error Modified car.\n";
}

// Select the car from the database
$selectedCar = $client->selectCar("BMW");
print_r($selectedCar);
