<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $employee_id = $_POST['employee_id'];
    $report_content = $_POST['report_content'];

    // Insert the report into the reports table
    $insert_sql = "INSERT INTO reports (employee_id, report_content) VALUES (:employee_id, :report_content)";
    $insert_stmt = $database->prepare($insert_sql);
    $insert_stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $insert_stmt->bindParam(':report_content', $report_content, PDO::PARAM_STR);

    if ($insert_stmt->execute()) {
        echo "<p>Report successfully added for Employee ID: $employee_id</p>";
        echo '<a href="add_report.php">Back to Employee List</a>';
    } else {
        echo "<p>Failed to add the report. Please try again.</p>";
    }
} else {
    // Display the form
    $employee_id = $_GET['employee_id'] ?? null;
    if (!$employee_id) {
        die("Employee ID not provided.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Report</title>
    <link rel="stylesheet" href="style-absent.css">
</head>
<body>
    <div>
        <h1 class="header">Add Report for Employee ID: <?= htmlspecialchars($employee_id) ?></h1>

        <form action="insert_report.php" method="POST" class="report-form">
            <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee_id) ?>">
            <label for="report_content">Report Content:</label><br>
            <textarea name="report_content" id="report_content" rows="5" cols="70" required></textarea><br>
            <button type="submit" class="action-button">Save Report</button>
        </form>
    </div>
</body>
</html>
