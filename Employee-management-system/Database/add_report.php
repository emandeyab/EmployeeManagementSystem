<?php
include 'config.php';

// Fetch employee details from person and employee tables
$sql = "SELECT e.employee_id, p.first_name, p.last_name
        FROM employee e
        JOIN person p ON e.person_id = p.person_id";
$stmt = $database->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Reports</title>
    <link rel="stylesheet" href="style-absent.css">
</head>
<body>
	<h1 >Submit Reports For Employees </h1>
	<div>
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
                        <td><?= htmlspecialchars($employee['employee_id']) ?></td>
                        <td><?= htmlspecialchars($employee['first_name']) . ' ' . htmlspecialchars($employee['last_name']) ?></td>
                        <td>
                            <form action="insert_report.php" method="GET">
                                <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee['employee_id']) ?>">
                                <button type="submit" class="action-button">Add Report</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
