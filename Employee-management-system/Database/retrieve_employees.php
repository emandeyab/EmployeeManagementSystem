<?php
include 'config.php';

// Query to fetch employee data
$sql = "SELECT person_id, first_name, last_name FROM person WHERE role = 'employee'";
$stmt = $database->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-absent.css">
    <title>Employees Absent</title>
</head>
<body>
       
	<h1 style="text-align: center; margin-bottom: 20px;">Submit Employees Absent</h1>
	<table border="1">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['person_id']) ?></td>
                    <td><?= htmlspecialchars($employee['first_name']) . ' ' . htmlspecialchars($employee['last_name']) ?></td>
                    <td>
                        <form action="update_absent.php" method="POST">
                            <input type="hidden" name="person_id" value="<?= htmlspecialchars($employee['person_id']) ?>">
                            <button type="submit">Mark Absent</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

