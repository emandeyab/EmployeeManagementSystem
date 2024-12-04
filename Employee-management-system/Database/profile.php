<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in (session ID is set)
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not logged in
    header("Location: login_admin.php");
    exit();
}

// Database connection
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$host = "localhost"; // Usually localhost for local development
$dbname = "emp"; // Replace with your database name

try {
    $database = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Retrieve user data based on the session admin ID
$admin_id = $_SESSION['admin_id']; // Get the admin ID from session

$query = "
    SELECT 
        admin.admin_id, 
        admin.email, 
        person.first_name, 
        person.last_name, 
        person.phone_number AS phone, 
        person.address, 
        person.job_title AS job, 
        person.salary 
    FROM 
        admin 
    JOIN 
        person 
    ON 
        admin.person_id = person.person_id 
    WHERE 
        admin.admin_id = :admin_id
";
$stmt = $database->prepare($query);
$stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch admin data
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin) {
    // Assign variables for easy access
    $id = $admin['admin_id'];
    $fname = $admin['first_name'];
    $lname = $admin['last_name'];
    $email = $admin['email'];
    $phone = $admin['phone'];
    $address = $admin['address'];
    $job = $admin['job'];
    $salary = $admin['salary'];
} else {
    echo "Admin not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $updated_fname = $_POST['fname'];
    $updated_lname = $_POST['lname'];
    $updated_email = $_POST['email'];
    $updated_phone = $_POST['phone'];
    $updated_address = $_POST['address'];
    $updated_salary = $_POST['salary'];

    // Update the database with the new values
    $update_query = "
        UPDATE person
        SET 
            first_name = :first_name, 
            last_name = :last_name, 
            phone_number = :phone, 
            address = :address, 
            salary = :salary
        WHERE 
            person_id = (SELECT person_id FROM admin WHERE admin_id = :admin_id)
    ";

    $update_stmt = $database->prepare($update_query);
    $update_stmt->bindParam(':first_name', $updated_fname);
    $update_stmt->bindParam(':last_name', $updated_lname);
    $update_stmt->bindParam(':phone', $updated_phone);
    $update_stmt->bindParam(':address', $updated_address);
    $update_stmt->bindParam(':salary', $updated_salary);
    $update_stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo "Profile updated successfully!";
        // Optionally redirect or reload the page after successful update
        header("Refresh: 1");  // Refresh page to see updated values
    } else {
        echo "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        My profile
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>

<body>
    <div class="row">
        <div class="sidebar">
            <div class="brand">EMS</div>
            <a href="dashboard.php">Dashboard</a>
            <a href="">Manage Managers</a>
            <a href="">Manage Employees</a>
            <a href="">Manage Departments</a>
            <a href="viewProfile.php">View Profile</a>
          </div>

        <div class="col-md-8 mt-1" style="padding-top: 3%;">
            <div class="card mb-3 content">
                <h1 class="m-3 pt-3">About</h1>
                <div class="card-body">
                    <form id="profileForm" action="profile.php" method="POST">
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>ID Number</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly>

                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>First Name</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($fname); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Last Name</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($lname); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Email</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Phone</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="tel" id="phone" name="phone"  value="<?php echo htmlspecialchars($phone); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Address</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Job title</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="job" name="job" value="<?php echo htmlspecialchars($job); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row-1">
                        <div class="col-md-3">
                            <h5>Salary</h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            <input type="text" id="salary" name="salary" value="<?php echo htmlspecialchars($salary); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" id="saveButton" name="update_profile" style="display: none;">Save</button>
                </form>
                </div>
            </div>
            <button id="editButton" onclick="toggleEdit()">Edit Profile</button>
        
        </div>
    </div>
    <script>
        function toggleEdit() {
            let inputs = document.querySelectorAll('#profileForm input');
            let saveButton = document.getElementById('saveButton');
            let editButton = document.getElementById('editButton');
            let isReadOnly = inputs[1].hasAttribute('readonly');

            inputs.forEach(input => {
                // Ensure that ID and Job Title fields are never editable
                if (input.id !== 'id' && input.id !== 'job') {
                    input.readOnly = !isReadOnly;
                }
            });

            saveButton.style.display = isReadOnly ? 'inline-block' : 'none';
            editButton.textContent = isReadOnly ? 'Cancel' : 'Edit Profile';
        }
    </script>
</body>

</html>
