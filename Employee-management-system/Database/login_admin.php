<?php
session_start();  // Start the session to track user data

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=emp; charset=utf8;", $username, $password);

if(!$database) {
    die("Connection failed: " . $database->errorInfo());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "
         SELECT 
            person.person_id, 
            person.first_name, 
            person.last_name, 
            person.role, 
            admin.password AS admin_password,
            manager.password AS manager_password,
            employee.password AS employee_password,
            employee.logi_id,
            admin.admin_id,
            manager.manager_id,
            employee.employee_id
        FROM 
            person 
        LEFT JOIN admin  ON admin.admin_id = person.person_id
        LEFT JOIN manager  ON manager.manager_id = person.person_id
        LEFT JOIN employee  ON employee.employee_id = person.person_id
        WHERE 
            admin.email = :email OR manager.email = :email OR employee.logi_id = :email
    ";

    $stmt = $database->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $isPasswordValid = false;

        // Check against the correct table's password based on the role
        if ($user['role'] == 'admin' && $user['admin_password'] == $password) {
            $isPasswordValid = true;
        } elseif ($user['role'] == 'manager' && $user['manager_password'] == $password) {
            $isPasswordValid = true;
        } elseif ($user['role'] == 'employee' && $user['employee_password'] == $password) {
            $isPasswordValid = true;
        }

        if ($isPasswordValid) {
            // Store session data
            $_SESSION['person_id'] = $user['person_id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header("Location: dashboard.php");
                    break;
                case 'manager':
                    header("Location: dashboard_man.php");
                    break;
                case 'employee':
                    header("Location: dashboard_emp.php");
                    break;
                default:
                    $error_message = "Role not recognized.";
                    break;
            }
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Email not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_admin.php" method="POST">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
