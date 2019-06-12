<?php




try {
	$db = new PDO('mysql:host=localhost;dbname=employees;charset=utf8mb4', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->beginTransaction();
 

 	$stmt = $db->prepare("SELECT * FROM `clients`");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("SELECT * FROM `clients` WHERE is_active=:is_active");
	$stmt->bindValue(':is_active', 1, PDO::PARAM_INT);
	$stmt->execute();
	$stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("SELECT * FROM `clients` WHERE age>=:age");
	$stmt->bindValue('age', 30, PDO::PARAM_INT);
	$stmt->execute();
	$stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("SELECT * FROM `clients` WHERE first_name LIKE 'О%'");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("SELECT count(id) as all_clients FROM `clients`");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT max(age) as max_age FROM `clients`");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT COUNT(id) as active_clients FROM `clients` WHERE is_active = ?");
	$stmt->execute([1]);
	$stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $db->prepare("SELECT * FROM `clients` ORDER BY age");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT * FROM `clients` ORDER BY first_name");
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->prepare("SELECT * FROM `clients` WHERE age>:age");
	$stmt->bindValue('age', 25, PDO::PARAM_INT);
	$stmt->execute();
	$stmt->fetchAll(PDO::FETCH_ASSOC);


	
	

	$stmt = $db->prepare("INSERT INTO clients (`id`,`first_name`,`last_name`,`email`,`company_name`,`is_active`,`age`) VALUES(:id,:first_name,:last_name,:email,:company_name,:is_active,:age)");
	$stmt->execute(array(':id' => 9, ':first_name' => 'Коля', ':last_name' => 'Косенко', ':email' => 'kolya@gmail.com', ':company_name' => 'ПриватБанк', ':is_active' => 1, ':age' => 22));
	$affected_rows = $stmt->rowCount();

	$stmt = $db->prepare("INSERT INTO `clients`(`id`, `first_name`, `last_name`, `email`, `company_name`, `is_active`, `age`) VALUES(:id,:first_name,:last_name,:email,:company_name,:is_active,:age)");
	$stmt->execute(array(':id' => 10, ':first_name' => 'Света', ':last_name' => 'Моисеенко', ':email' => 'sveta@gmail.com', ':company_name' => 'ПриватБанк', ':is_active' => 0, ':age' => 35));
	$affected_rows = $stmt->rowCount();

	$stmt = $db->prepare("INSERT INTO `clients`(`id`, `first_name`, `last_name`, `email`, `company_name`, `is_active`, `age`) VALUES(:id,:first_name,:last_name,:email,:company_name,:is_active,:age)");
	$stmt->execute(array(':id' => 11, ':first_name' => 'Марина', ':last_name' => 'Ткачева', ':email' => 'marina@gmail.com', ':company_name' => 'ПриватБанк', ':is_active' => 1, ':age' => 49));
	$affected_rows = $stmt->rowCount();




	$stmt = $db->prepare("UPDATE `clients` SET age=:age WHERE id=:id");
	$stmt->bindValue('age', 45, PDO::PARAM_INT);
	$stmt->bindValue('id', 2, PDO::PARAM_INT);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();
	
	$stmt = $db->prepare("UPDATE `clients` SET first_name=:first_name WHERE id=:id");
	$stmt->bindValue('first_name', 'Сергей', PDO::PARAM_STR);
	$stmt->bindValue('id', 1, PDO::PARAM_INT);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();

	$stmt = $db->prepare("UPDATE `clients` SET is_active=:is_active WHERE id=:id");
	$stmt->bindValue('is_active', 0, PDO::PARAM_INT);
	$stmt->bindValue('id', 3, PDO::PARAM_INT);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();
 

	$stmt = $db->prepare("DELETE FROM `clients` WHERE is_active=:is_active");
	$stmt->bindValue('is_active', 0, PDO::PARAM_INT);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();

	$stmt = $db->prepare("DELETE FROM `clients`");
	$stmt->execute();
	$affected_rows = $stmt->rowCount();
	var_dump($affected_rows);
 


    $db->commit();
} catch(PDOException $ex) {
    $db->rollBack();
    echo $ex->getMessage();
}
