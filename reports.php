<?php
// dashboard.php
session_start();
include 'db.php';

if (!isset($_SESSION['patient_id'])) {
  header('Location: login.php');
  exit();
}

$patient_id = $_SESSION['patient_id'];

// Fetch hospitals
$hospitals = $conn->query("SELECT * FROM hospitals");
if (!$hospitals) {
  die("Error fetching hospitals: " . $conn->error);
}

// Fetch reports
$reports = $conn->query("SELECT * FROM reports WHERE patient_id = $patient_id");
if (!$reports) {
  die("Error fetching reports: " . $conn->error);
}
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
          <img src="assets/elonmusk.jpg" alt="Profile" class="rounded-full size-14 object-cover" />
          <div class="ml-3">
            <h2 class="text-lg font-semibold text-slate-200">Elon Tiwari</h2>
            <p class="text-sm text-gray-600 text-slate-200">
              elon_01@gmail.com
            </p>
          </div>
        </div>
      </div>
      <nav class="mt-6">
        <a href="dashboard.php" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
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
        <a href="reports.php" class="block px-6 py-3 text-gray-700 bg-gray-800 flex gap-x-2 items-center">
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
          <div class="text-slate-200">Reports</div>
        </a>
        <a href="view-doctors.php" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>
            <img src="assets/list-heart.svg" alt="doctor list" class="" />
          </div>
          <div class="text-slate-200">View Doctors</div>
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
          <div class="text-slate-200">Tracking</div>
        </a>
        <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-gray-800 flex gap-x-2 items-center">
          <div>
            <svg fill="#ffffff" width="16" height="16" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
              <title>Artboard 16</title>
              <path d="M60.21,47l0-.06A7.49,7.49,0,0,0,51,41.7c-3.41,1-8.09,2.4-11.62,3.42A4.68,4.68,0,0,0,39.29,42c-.9-2.25-3.41-3.26-5.51-3.26H24a3.94,3.94,0,0,1-2.58-1.2,5.65,5.65,0,0,0-3.84-1.5H9.67a6.34,6.34,0,0,0-6.21,6.46V55.09a6.46,6.46,0,0,0,6.32,6.58h9.51a6.13,6.13,0,0,0,3.42-1.06l.1,0A18.75,18.75,0,0,0,31.87,63a18.47,18.47,0,0,0,5.56-.84l17.66-5.39.13,0A7.74,7.74,0,0,0,60.21,47ZM9.78,57.67a2.46,2.46,0,0,1-2.32-2.58V42.54a2.34,2.34,0,0,1,2.21-2.46h7.9a1.63,1.63,0,0,1,1.14.45,10.64,10.64,0,0,0,.94.75V57.63a2.2,2.2,0,0,1-.36,0ZM53.86,53,36.24,58.34a14.27,14.27,0,0,1-4.37.66,14.8,14.8,0,0,1-7.16-1.85l-1.06-.57V42.76l.34,0h9.79a2.08,2.08,0,0,1,1.8.75c.14.36-.12,1.55-2.15,3.48L32.28,48.1l.79,1.37c.81,1.4,1.6,1.17,4.94.22,1.58-.45,3.69-1.06,5.79-1.68,4.18-1.22,8.36-2.47,8.36-2.47a3.53,3.53,0,0,1,4.21,2.53A3.76,3.76,0,0,1,53.86,53Z" />
              <path d="M50.55,15.61a7.31,7.31,0,1,0-7.31-7.3A7.32,7.32,0,0,0,50.55,15.61ZM50.55,5a3.31,3.31,0,1,1-3.31,3.31A3.31,3.31,0,0,1,50.55,5Z" />
              <path d="M48.18,37.38h3.3a7.26,7.26,0,0,0,7.25-7.25V24.44a7.26,7.26,0,0,0-7.25-7.25h-3a7.26,7.26,0,0,0-7.25,7.25V30.1A7.22,7.22,0,0,0,48.18,37.38ZM45.24,24.44a3.25,3.25,0,0,1,3.25-3.25h3a3.26,3.26,0,0,1,3.25,3.25v5.69a3.26,3.26,0,0,1-3.25,3.25h-3.3a3.2,3.2,0,0,1-2.94-3.32Z" />
            </svg>
          </div>
          <div class="text-slate-200">Contact</div>
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

      <main class="mt-6 space-y-12">
        <!-- Projects -->
        <div class="shadow-2xl p-4 rounded-lg">
          <h1 class="text-[#5AC0BC] font-bold text-2xl mb-3 px-3">
            Test Reports
          </h1>

          <div class="flex justify-between items-center mt-8">
            <?php while ($row = $reports->fetch_assoc()) : ?>

              <div class="flex gap-x-6 px-2">
                <div class="icon inline-block px-2 py-2 bg-teal-700 hover:bg-teal-600 rounded-md">

                  <svg fill="#1C2033" width="32" height="32" version="1.1" id="lni_lni-add-files" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
                    <g>
                      <path d="M38.6,22.1h-4.3v-4.3c0-1.2-1-2.3-2.3-2.3c-1.2,0-2.3,1-2.3,2.3v4.3h-4.3c-1.2,0-2.3,1-2.3,2.3s1,2.3,2.3,2.3h4.3v4.3
      c0,1.2,1,2.3,2.3,2.3c1.2,0,2.3-1,2.3-2.3v-4.3h4.3c1.2,0,2.3-1,2.3-2.3S39.8,22.1,38.6,22.1z" />
                      <path d="M50,1.8H14c-3.4,0-6.1,2.7-6.1,6.1v32.1c0,1.5,0.6,2.9,1.7,3.9l18,17c1,1,2.3,1.5,3.7,1.5H50c3.4,0,6.1-2.7,6.1-6.1V7.9
      C56.1,4.5,53.4,1.8,50,1.8z M15.7,43.4h11.7c0.5,0,0.9,0.4,0.9,0.8v11L15.7,43.4z M51.6,56.1c0,0.9-0.7,1.6-1.6,1.6H32.8V44.2
      c0-2.9-2.4-5.3-5.4-5.3h-15v-31c0-0.9,0.7-1.6,1.6-1.6h36c0.9,0,1.6,0.7,1.6,1.6V56.1z" />
                    </g>
                  </svg>
                </div>
                <div class="">
                  <div class="test-title text-gray-200 text-lg">
                    <?php echo htmlspecialchars($row['report']); ?>
                  </div>
                  <div class="test-date text-sm text-gray-400">
                    12th July 2024
                  </div>
                </div>
              </div>
            <?php endwhile; ?>

          </div>
        </div>
        <div class="shadow-2xl p-4 rounded-lg">
          <h1 class="text-[#5AC0BC] font-bold text-2xl mb-3 px-3">
            Prescriptions
          </h1>

          <div class="flex justify-between items-center mt-8 px-4">
            <div class="inline-block px-3 py-6 bg-teal-700 rounded-xl  space-y-4">
              <div class="text-center">
                <div class="title text-xl tracking-wider font-semibold text-gray-300">
                  Common Cold
                </div>
                <div class="duration text-gray-400 text-lg">3 months</div>
              </div>
              <div class="time-frame flex justify-center items-center gap-x-2 text-[#5AC0BC]">
                <div class="from">25 July 2024</div>
                <!-- Generator: Adobe Illustrator 25.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg fill="#5AC0BC" width="20" height="20" version="1.1" id="lni_lni-arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
                  <path d="M57.6,30.4l-20.7-21c-0.9-0.9-2.3-0.9-3.2,0c-0.9,0.9-0.9,2.3,0,3.2l16.8,17.1H8c-1.2,0-2.2,1-2.2,2.2s1,2.3,2.2,2.3h42.7
	l-17,17.3c-0.9,0.9-0.9,2.3,0,3.2c0.4,0.4,1,0.6,1.6,0.6c0.6,0,1.2-0.2,1.6-0.7l20.7-21C58.5,32.7,58.5,31.3,57.6,30.4z" />
                </svg>
                <div class="to">25 Oct 2024</div>
              </div>
              <div class="medicine flex items-center gap-x-3">
                <div class="">
                  <img src="assets/pill.svg " alt="pill" class="size-9" />
                </div>
                <div class="medicine-names text-gray-300">
                  <h2 class="med-1">Eplerenone (Inspra)</h2>
                  <h2 class="med-2">Spironolactone (Aldactone)</h2>
                </div>
              </div>
            </div>
            <div class="inline-block px-3 py-6 bg-teal-700 rounded-xl  space-y-4">
              <div class="text-center">
                <div class="title text-xl tracking-wider font-semibold text-gray-300">
                  Common Cold
                </div>
                <div class="duration text-gray-400 text-lg">3 months</div>
              </div>
              <div class="time-frame flex justify-center items-center gap-x-2 text-[#5AC0BC]">
                <div class="from">25 July 2024</div>
                <!-- Generator: Adobe Illustrator 25.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg fill="#5AC0BC" width="20" height="20" version="1.1" id="lni_lni-arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
                  <path d="M57.6,30.4l-20.7-21c-0.9-0.9-2.3-0.9-3.2,0c-0.9,0.9-0.9,2.3,0,3.2l16.8,17.1H8c-1.2,0-2.2,1-2.2,2.2s1,2.3,2.2,2.3h42.7
	l-17,17.3c-0.9,0.9-0.9,2.3,0,3.2c0.4,0.4,1,0.6,1.6,0.6c0.6,0,1.2-0.2,1.6-0.7l20.7-21C58.5,32.7,58.5,31.3,57.6,30.4z" />
                </svg>
                <div class="to">25 Oct 2024</div>
              </div>
              <div class="medicine flex items-center gap-x-3">
                <div class="">
                  <img src="assets/pill.svg " alt="pill" class="size-9" />
                </div>
                <div class="medicine-names text-gray-300">
                  <h2 class="med-1">Eplerenone (Inspra)</h2>
                  <h2 class="med-2">Spironolactone (Aldactone)</h2>
                </div>
              </div>
            </div>
            <div class="inline-block px-3 py-6 bg-teal-700 rounded-xl  space-y-4">
              <div class="text-center">
                <div class="title text-xl tracking-wider font-semibold text-gray-300">
                  Common Cold
                </div>
                <div class="duration text-gray-400 text-lg">3 months</div>
              </div>
              <div class="time-frame flex justify-center items-center gap-x-2 text-[#5AC0BC]">
                <div class="from">25 July 2024</div>
                <!-- Generator: Adobe Illustrator 25.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg fill="#5AC0BC" width="20" height="20" version="1.1" id="lni_lni-arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
                  <path d="M57.6,30.4l-20.7-21c-0.9-0.9-2.3-0.9-3.2,0c-0.9,0.9-0.9,2.3,0,3.2l16.8,17.1H8c-1.2,0-2.2,1-2.2,2.2s1,2.3,2.2,2.3h42.7
	l-17,17.3c-0.9,0.9-0.9,2.3,0,3.2c0.4,0.4,1,0.6,1.6,0.6c0.6,0,1.2-0.2,1.6-0.7l20.7-21C58.5,32.7,58.5,31.3,57.6,30.4z" />
                </svg>
                <div class="to">25 Oct 2024</div>
              </div>
              <div class="medicine flex items-center gap-x-3">
                <div class="">
                  <img src="assets/pill.svg " alt="pill" class="size-9" />
                </div>
                <div class="medicine-names text-gray-300">
                  <h2 class="med-1">Eplerenone (Inspra)</h2>
                  <h2 class="med-2">Spironolactone (Aldactone)</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>