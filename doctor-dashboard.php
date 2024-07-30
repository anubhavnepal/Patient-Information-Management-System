<?php
include('db.php');

// Handle form submissions for Add, Edit, and Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $condition = $_POST['condition'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO patients (name, age, gender, `condition`, password) VALUES ('$name', '$age', '$gender', '$condition', '$password')";
    $conn->query($sql);
  } elseif (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $condition = $_POST['condition'];

    $sql = "UPDATE patients SET name='$name', age='$age', gender='$gender', `condition`='$condition' WHERE id='$id'";
    $conn->query($sql);
  } elseif (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Debugging
    error_log("Attempting to delete ID: " . $id);

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
      error_log("Successfully deleted ID: " . $id);
    } else {
      error_log("Failed to delete ID: " . $id);
    }

    $stmt->close();
  }
}

// Fetch all patients from the database
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 shadow-md text-white">
      <div class="p-6">
        <div class="flex items-center">
          <img src="assets/doctors/doc6.jpg" alt="Profile" class="rounded-full size-14" />
          <div class="ml-3">
            <h2 class="text-lg font-semibold text-slate-200">Anila Sharma</h2>
            <p class="text-sm text-gray-600 text-slate-200">
              sharmanila@gmail.com
            </p>
          </div>
        </div>
      </div>
      <nav class="mt-6">
        <a href="/" class="block px-6 py-3 text-gray-700 bg-gray-800 flex gap-x-2 items-center">
          <div>
            <svg fill="#ffffff" width="16" height="16" version="1.1" id="lni_lni-home" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
              <g>
                <path d="M56.4,62.3H43.3c-3.2,0-5.9-2.6-5.9-5.9V45.8c0-0.8-0.6-1.4-1.4-1.4h-8c-0.8,0-1.4,0.6-1.4,1.4v10.6c0,3.3-2.6,5.9-5.9,5.9
		H7.6c-3.2,0-5.9-2.6-5.9-5.9V22.7c0-1.7,0.8-3.2,2.2-4.1L29.4,2.5c1.6-1,3.6-1,5.1,0L60,18.7c1.4,0.9,2.2,2.4,2.2,4.1v33.6
		C62.3,59.6,59.6,62.3,56.4,62.3z M28,39.9h8c3.3,0,5.9,2.6,5.9,5.9v10.6c0,0.8,0.6,1.4,1.4,1.4h13.1c0.8,0,1.4-0.6,1.4-1.4V22.7
		c0-0.1-0.1-0.2-0.1-0.3L32.1,6.3c-0.1-0.1-0.2-0.1-0.3,0L6.4,22.4c-0.1,0.1-0.2,0.2-0.2,0.3v33.7c0,0.8,0.6,1.4,1.4,1.4h13.1
		c0.8,0,1.4-0.6,1.4-1.4V45.8C22.1,42.6,24.7,39.9,28,39.9z" />
              </g>
            </svg>
          </div>
          <div class="text-slate-200">Dashboard</div>
        </a>
        <a href="reports.php" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>
            <!-- Generator: Adobe Illustrator 25.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg fill="#ffffff" width="16" height="16" version="1.1" id="lni_lni-postcard" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
              <g>
                <path d="M56,11.9H8c-3.4,0-6.2,2.8-6.2,6.2v27.7c0,3.4,2.8,6.2,6.2,6.2h48c3.4,0,6.2-2.8,6.2-6.2V18.2C62.2,14.7,59.4,11.9,56,11.9
		z M57.8,45.8c0,1-0.8,1.8-1.8,1.8H8c-1,0-1.8-0.8-1.8-1.8V18.2c0-1,0.8-1.8,1.8-1.8h48c1,0,1.8,0.8,1.8,1.8V45.8z" />
                <path d="M32,20.9c-1.2,0-2.2,1-2.2,2.2v15.3c0,1.2,1,2.2,2.2,2.2c1.2,0,2.2-1,2.2-2.2V23.1C34.2,21.9,33.2,20.9,32,20.9z" />
                <path d="M11.6,33h8.9c1.2,0,2.2-1,2.2-2.2s-1-2.2-2.2-2.2h-8.9c-1.2,0-2.2,1-2.2,2.2S10.4,33,11.6,33z" />
                <path d="M52,20.9h-9.4c-1.5,0-2.6,1.2-2.6,2.6v9.4c0,1.4,1.2,2.6,2.6,2.6H52c1.4,0,2.6-1.2,2.6-2.6v-9.4C54.6,22,53.4,20.9,52,20.9
		z M50.1,31h-5.7v-5.7h5.7V31z" />
                <path d="M23,36.1H11.6c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2H23c1.2,0,2.2-1,2.2-2.2S24.3,36.1,23,36.1z" />
              </g>
            </svg>
          </div>
          <div class="text-slate-200">Manage Reports</div>
        </a>
        <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>
            <img src="assets/message-dm.svg" alt="message-dm" class="">
          </div>
          <div class="text-slate-200">Inbox</div>
        </a>
        <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>
            <!-- Generator: Adobe Illustrator 22.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg fill="#ffffff" width="16" height="16" version="1.1" id="lni_lni-calendar" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
              <g>
                <path d="M20.5,36.6h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C21.5,37.1,21,36.6,20.5,36.6z" />
                <path d="M33.5,36.6h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C34.5,37.1,34.1,36.6,33.5,36.6z" />
                <path d="M46.6,36.6h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C47.6,37.1,47.2,36.6,46.6,36.6z" />
                <path d="M20.5,49.5h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C21.5,50,21,49.5,20.5,49.5z" />
                <path d="M33.5,49.5h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C34.5,50,34.1,49.5,33.5,49.5z" />
                <path d="M46.6,49.5h-3.1c-0.6,0-1,0.4-1,1v3c0,0.6,0.4,1,1,1h3.1c0.6,0,1-0.4,1-1v-3C47.6,50,47.2,49.5,46.6,49.5z" />
                <path d="M56,15.4H34.3v-1.9c2.3-0.9,3.9-3.1,3.9-5.7c0-3.4-2.8-6.1-6.2-6.1s-6.2,2.7-6.2,6.1c0,2.6,1.6,4.8,3.9,5.7v1.9H8
		c-3.4,0-6.3,2.8-6.3,6.3V56c0,3.4,2.8,6.3,6.3,6.3h48c3.4,0,6.3-2.8,6.3-6.3V21.6C62.3,18.2,59.4,15.4,56,15.4z M32,6.2
		c0.9,0,1.7,0.7,1.7,1.6c0,0.9-0.7,1.6-1.7,1.6s-1.7-0.7-1.7-1.6C30.3,6.9,31.1,6.2,32,6.2z M8,19.9h48c1,0,1.8,0.8,1.8,1.8v6.2H6.3
		v-6.2C6.3,20.6,7,19.9,8,19.9z M56,57.8H8c-1,0-1.8-0.8-1.8-1.8V32.3h51.5V56C57.8,57,57,57.8,56,57.8z" />
              </g>
            </svg>
          </div>
          <div class="text-slate-200">View Appointments</div>
        </a>
        <a href="logout.php" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>

            <svg class="rotate-180" fill="#ffffff" width="16" height="16" version="1.1" id="lni_lni-exit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
              <g>
                <path d="M45.2,1.8H33.9c-2.6,0-4.8,2.2-4.8,4.8v6.9c0,1.2,1,2.2,2.2,2.2s2.3-1,2.3-2.2V6.5c0-0.2,0.1-0.3,0.3-0.3h11.3
		c2.4,0,4.3,1.9,4.3,4.3v42.9c0,2.4-1.9,4.3-4.3,4.3H33.9c-0.2,0-0.3-0.1-0.3-0.3v-6.9c0-1.2-1-2.2-2.3-2.2s-2.2,1-2.2,2.2v6.9
		c0,2.6,2.2,4.8,4.8,4.8h11.3c4.9,0,8.8-4,8.8-8.8V10.6C54,5.7,50,1.8,45.2,1.8z" />
                <path d="M17.6,34.2h17.9c1.2,0,2.2-1,2.2-2.2c0-1.2-1-2.2-2.2-2.2H17.7l6.2-6.3c0.9-0.9,0.9-2.3,0-3.2c-0.9-0.9-2.3-0.9-3.2,0
		l-10,10.2c-0.9,0.9-0.9,2.3,0,3.2l10,10.2c0.4,0.4,1,0.7,1.6,0.7c0.6,0,1.1-0.2,1.6-0.6c0.9-0.9,0.9-2.3,0-3.2L17.6,34.2z" />
              </g>
            </svg>

          </div>
          <div class="text-slate-200">Log Out</div>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-teal-800 rounded-l-xl">
      <header class="flex items-center justify-between shadow-md py-4 rounded-xl px-3">
        <div>
          <h1 class="text-2xl font-semibold text-zinc-200">Welcome, Dr. Anila</h1>
          <p class="text-zinc-200 text-xs mt-2">
            Today is Monday, 19 July 2024
          </p>
        </div>
        <button class="px-4 py-2 bg-gray-900 text-zinc-100 rounded-lg flex items-center gap-x-3">
          <div class="dm-icon">
            <img src="assets/message-dm.svg" alt="message-dm" class="">
          </div>
          <span>
            View Messages
          </span>
        </button>
      </header>

      <main class="mt-6">
        <h1 class="text-[#5AC0BC] font-bold text-2xl mb-3 px-3">Patient Information</h1>
        <div class="shadow-2xl rounded-lg p-4">
          <table class="min-w-full leading-normal">
            <thead>
              <tr>
                <th class="px-5 py-3 border-b-2 border-[#1A857F] bg-teal-700 text-left text-xs font-semibold text-[#E0E0E0] uppercase tracking-wider">Patient Name</th>
                <th class="px-5 py-3 border-b-2 border-[#1A857F] bg-teal-700 text-left text-xs font-semibold text-[#E0E0E0] uppercase tracking-wider">Age</th>
                <th class="px-5 py-3 border-b-2 border-[#1A857F] bg-teal-700 text-left text-xs font-semibold text-[#E0E0E0] uppercase tracking-wider">Gender</th>
                <th class="px-5 py-3 border-b-2 border-[#1A857F] bg-teal-700 text-left text-xs font-semibold text-[#E0E0E0] uppercase tracking-wider">Condition</th>
                <th class="px-5 py-3 border-b-2 border-[#1A857F] bg-teal-700 text-left text-xs font-semibold text-[#E0E0E0] uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td class="px-5 py-5 border-b border-[#1A857F] text-sm">
                    <div class="flex items-center">
                      <div class="ml-3">
                        <p class="text-[#C3C3C3] whitespace-no-wrap"><?php echo $row['name']; ?></p>
                      </div>
                    </div>
                  </td>
                  <td class="px-5 py-5 border-b border-[#1A857F] text-sm">
                    <p class="text-[#C3C3C3] whitespace-no-wrap"><?php echo $row['age']; ?></p>
                  </td>
                  <td class="px-5 py-5 border-b border-[#1A857F] text-sm">
                    <p class="text-[#C3C3C3] whitespace-no-wrap"><?php echo $row['gender']; ?></p>
                  </td>
                  <td class="px-5 py-5 border-b border-[#1A857F] text-sm">
                    <p class="text-[#C3C3C3] whitespace-no-wrap"><?php echo $row['condition']; ?></p>
                  </td>
                  <td class="px-5 py-5 border-b border-[#1A857F] text-sm">
                    <button class="text-sky-400 hover:text-sky-500" onclick="editPatient(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', <?php echo $row['age']; ?>, '<?php echo $row['gender']; ?>', '<?php echo $row['condition']; ?>')">Edit</button>
                    <form method="POST" action="doctor-dashboard.php" style="display:inline;">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete" class="text-[#FF6161] hover:text-red-500 ml-4">
                        Delete
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="mt-6">
            <button class="flex items-center gap-x-3 bg-gray-900 hover:bg-gray-800 text-zinc-100 rounded-lg px-4 py-3" onclick="showAddForm()">
              <svg fill="rgb(244 244 245)" width="17" height="17" version="1.1" id="lni_lni-plus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
                <path d="M60,29.8H34.3V4c0-1.2-1-2.3-2.3-2.3c-1.2,0-2.3,1-2.3,2.3v25.8H4c-1.2,0-2.3,1-2.3,2.3c0,1.2,1,2.3,2.3,2.3h25.8V60c0,1.2,1,2.3,2.3,2.3c1.2,0,2.3-1,2.3-2.3V34.3H60c1.2,0,2.3-1,2.3-2.3C62.3,30.8,61.2,29.8,60,29.8z"></path>
              </svg>
              <span class="">Add New Patient</span>
            </button>
          </div>
        </div>
      </main>

      <!-- Add Patient Form -->
      <div id="addForm" class="hidden fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex items-center">
              <h3 class="text-lg leading-6 font-medium text-white">
                Add Patient
              </h3>
              <button type="button" class="text-gray-400 hover:text-gray-500 ml-auto" onclick="closeAddForm()">
                <span class="sr-only">Close</span>
                <!-- Heroicon name: x -->
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            <form id="addPatientForm" class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="mb-4">
                <label for="addName" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" id="addName" name="name" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="mb-4">
                <label for="addAge" class="block text-sm font-medium text-gray-300">Age</label>
                <input type="number" id="addAge" name="age" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="mb-4">
                <label for="addGender" class="block text-sm font-medium text-gray-300">Gender</label>
                <select id="addGender" name="gender" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="addCondition" class="block text-sm font-medium text-gray-300">Condition</label>
                <input type="text" id="addCondition" name="condition" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="mb-4">
                <label for="addPassword" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="addPassword" name="password" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="bg-gray-800 py-3 sm:flex sm:flex-row-reverse items-center">
                <button type="button" onclick="addPatient()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Add
                </button>
                <button type="button" onclick="closeAddForm()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Edit Patient Form -->
      <div id="editForm" class="hidden fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex items-center">
              <h3 class="text-lg leading-6 font-medium text-white">
                Edit Patient
              </h3>
              <button type="button" class="text-gray-400 hover:text-gray-500 ml-auto" onclick="closeEditForm()">
                <span class="sr-only">Close</span>
                <!-- Heroicon name: x -->
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            <form id="editPatientForm" class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <input type="hidden" id="editId" name="id">
              <div class="mb-4">
                <label for="editName" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" id="editName" name="name" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="mb-4">
                <label for="editAge" class="block text-sm font-medium text-gray-300">Age</label>
                <input type="number" id="editAge" name="age" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="mb-4">
                <label for="editGender" class="block text-sm font-medium text-gray-300">Gender</label>
                <select id="editGender" name="gender" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="mb-4">
                <label for="editCondition" class="block text-sm font-medium text-gray-300">Condition</label>
                <input type="text" id="editCondition" name="condition" required class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              </div>
              <div class="bg-gray-800 py-3 sm:flex sm:flex-row-reverse items-center">
                <button type="button" onclick="updatePatient()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-800 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Update
                </button>
                <button type="button" onclick="closeEditForm()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        function showAddForm() {
          document.getElementById('addForm').classList.remove('hidden');
        }

        function closeAddForm() {
          document.getElementById('addForm').classList.add('hidden');
        }

        function showEditForm() {
          document.getElementById('editForm').classList.remove('hidden');
        }

        function closeEditForm() {
          document.getElementById('editForm').classList.add('hidden');
        }

        function addPatient() {
          const form = document.getElementById('addPatientForm');
          const formData = new FormData(form);

          fetch('add_patient.php', {
            method: 'POST',
            body: formData
          }).then(response => response.text()).then(data => {
            alert(data);
            location.reload();
          }).catch(error => {
            console.error('Error:', error);
          });
        }

        function editPatient(id, name, age, gender, condition) {
          document.getElementById('editId').value = id;
          document.getElementById('editName').value = name;
          document.getElementById('editAge').value = age;
          document.getElementById('editGender').value = gender;
          document.getElementById('editCondition').value = condition;
          showEditForm();
        }

        function updatePatient() {
          const form = document.getElementById('editPatientForm');
          const formData = new FormData(form);

          fetch('edit_patient.php', {
            method: 'POST',
            body: formData
          }).then(response => response.text()).then(data => {
            alert(data);
            location.reload();
          }).catch(error => {
            console.error('Error:', error);
          });
        }

        function deletePatient(id) {
          if (confirm('Are you sure you want to delete this patient?')) {
            console.log('Patient ID to delete:', id); // Debugging log
            document.getElementById('deleteId').value = id;
            const form = document.getElementById('deletePatientForm');
            const formData = new FormData(form);

            fetch('delete_patient.php', {
              method: 'POST',
              body: formData
            }).then(response => response.text()).then(data => {
              console.log('Response from server:', data); // Debugging log
              alert(data);
              location.reload();
            }).catch(error => {
              console.error('Error:', error);
            });
          }
        }
      </script>
    </div>
  </div>
</body>

</html>