<?php
require_once 'Person.php';

echo "<pre>";

// Create a person
$person = new Person();
$person->firstname = "Alice";
$person->lastname = "Smith";
$person->birthdate = "1995-08-20";
$person->gender = "female";

$insertedId = $person->create();
echo "Created person with ID: $insertedId\n";

// Read the person
$data = $person->read($insertedId);
echo "Fetched person:\n";
print_r($data);

// Update the person
$person->firstname = "Alicia";
$person->lastname = "Smith-Jones";
$person->birthdate = "1995-08-20";
$person->gender = "female";
$person->update($insertedId);

echo "Updated person:\n";
print_r($person->read($insertedId));

// 4. Delete the person
$person->delete($insertedId);
echo "Deleted person with ID $insertedId\n";


echo "</pre>";
