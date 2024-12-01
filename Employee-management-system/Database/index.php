<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="role-selection-container">
        <h2>Select Your Role</h2>
        <form action="login_admin.php" method="GET">
            <button id="b1" type="submit" name="role" value="admin">Login as Admin</button>
        </form>
        <form action="login_manager.php" method="GET">
            <button id="b2" type="submit" name="role" value="manager">Login as Manager</button>
        </form>
        <form action="login_employee.php" method="GET">
            <button id="b3" type="submit" name="role" value="employee">Login as Employee</button>
        </form>
    </div>
</body>
</html>
