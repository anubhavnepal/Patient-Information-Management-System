<?php
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
        <a href="dashboard.php" class="block px-6 py-3 text-gray-700 bg-gray-800 flex gap-x-2 items-center">
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
      <header class="flex items-center justify-between shadow-md py-4 rounded-xl px-3">
        <div>
          <h1 class="text-2xl font-semibold text-zinc-200">Hello, Elon</h1>
          <p class="text-zinc-200 text-xs mt-2">
            Today is Monday, 19 July 2024
          </p>
        </div>
        <button class="px-4 py-2 bg-gray-900 text-zinc-100 rounded-lg">
          Make an appointment
        </button>
      </header>

      <main class="mt-6">
        <!-- Projects -->
        <h1 class="text-[#5AC0BC] font-bold text-2xl mb-3 px-3">
          Vital Statistics
        </h1>
        <div class="grid grid-cols-3 gap-6 py-4 px-3">
          <div class="w-56 p-4 space-y-4 rounded-md shadow-2xl hover:cursor-pointer hover:shadow-xl border border-[#146964] hover:border-[#189899]">

            <!-- Generator: Adobe Illustrator 22.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg fill="#E0E0E0" width="26" height="26" version="1.1" id="lni_lni-drop" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
              <g>
                <path d="M32,62.3c-13.7,0-24.8-11.1-24.8-24.8c0-18.2,22.5-34.6,23.4-35.3c0.8-0.6,1.9-0.6,2.7,0c1,0.7,23.4,18,23.4,35.3
		C56.8,51.1,45.7,62.3,32,62.3z M32,6.9c-4.7,3.7-20.2,17.1-20.2,30.6c0,11.2,9.1,20.3,20.3,20.3s20.3-9.1,20.3-20.3
		C52.3,24.6,36.7,10.8,32,6.9z" />
              </g>
            </svg>

            <h3 class="font-semibold text-xl text-[#E0E0E0]">
              Blood Pressure
            </h3>
            <p class="text-xl font-bold tracking-wider text-[#5AC0BC]">
              120/80
            </p>
            <!-- <div class="mt-2 w-full bg-purple-400 h-2 rounded"></div> -->
          </div>
          <div class="bg-teal-700 w-56 p-4 space-y-4 rounded-md hover:cursor-pointer hover:shadow-xl border border-[#146964] hover:border-[#189899]">
            <svg fill="#E0E0E0" width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.302 15.5001H21.002C17.702 15.5001 14.902 13.3001 14.202 10.3001C13.702 8.00014 14.402 5.60014 16.002 3.90014C17.702 2.20014 20.002 1.60014 22.302 2.10014C25.302 2.80014 27.502 5.70014 27.502 9.00014V13.3001C27.502 14.4001 26.502 15.5001 25.302 15.5001ZM18.602 9.20014C18.802 10.2001 19.902 10.9001 21.102 10.9001H23.102V8.90014C23.102 7.70014 22.402 6.60014 21.402 6.40014C20.602 6.20014 19.802 6.40014 19.302 7.00014C18.602 7.60014 18.402 8.40014 18.602 9.20014Z" />
              <path d="M21.6016 33.2998H11.1016C6.40156 33.2998 2.60156 29.4998 2.60156 24.7998C2.60156 20.0998 6.40156 16.2998 11.1016 16.2998H21.5016C26.2016 16.2998 30.0016 20.0998 30.0016 24.7998C30.0016 29.4998 26.2016 33.2998 21.6016 33.2998ZM11.1016 20.7998C8.90156 20.7998 7.10156 22.5998 7.10156 24.7998C7.10156 26.9998 8.90156 28.7998 11.1016 28.7998H21.5016C23.7016 28.7998 25.5016 26.9998 25.5016 24.7998C25.5016 22.5998 23.7016 20.7998 21.5016 20.7998H11.1016Z" />
              <path d="M39.0016 29.4002C34.4016 29.4002 30.6016 25.6002 30.6016 20.8002V10.3002C30.6016 5.6002 34.4016 1.7002 39.0016 1.7002C43.6016 1.7002 47.4016 5.5002 47.4016 10.3002V20.8002C47.4016 25.6002 43.7016 29.4002 39.0016 29.4002ZM39.0016 6.3002C36.8016 6.3002 35.1016 8.1002 35.1016 10.4002V20.9002C35.1016 23.1002 36.9016 25.0002 39.0016 25.0002C41.2016 25.0002 42.9016 23.2002 42.9016 20.9002V10.3002C42.9016 8.1002 41.2016 6.3002 39.0016 6.3002Z" />
              <path d="M52.1016 46.8002H44.0016C39.4016 46.8002 35.6016 43.1002 35.6016 38.5002C35.6016 33.9002 39.4016 30.2002 44.0016 30.2002H52.1016C56.7016 30.2002 60.5016 33.9002 60.5016 38.5002C60.5016 43.1002 56.7016 46.8002 52.1016 46.8002ZM44.0016 34.7002C41.9016 34.7002 40.1016 36.4002 40.1016 38.5002C40.1016 40.6002 41.8016 42.3002 44.0016 42.3002H52.1016C54.2016 42.3002 56.0016 40.6002 56.0016 38.5002C56.0016 36.4002 54.3016 34.7002 52.1016 34.7002H44.0016Z" />
              <path d="M26.5 60.8004C22.1 60.8004 18.5 57.1004 18.5 52.5004V44.2004C18.5 39.6004 22.1 35.9004 26.5 35.9004C30.9 35.9004 34.5 39.6004 34.5 44.2004V52.5004C34.5 57.1004 30.9 60.8004 26.5 60.8004ZM26.5 40.5004C24.6 40.5004 23 42.2004 23 44.3004V52.6004C23 54.7004 24.6 56.4004 26.5 56.4004C28.4 56.4004 30 54.7004 30 52.6004V44.3004C30 42.2004 28.5 40.5004 26.5 40.5004Z" />
              <path d="M54.6031 28.0998H50.5031C49.3031 28.0998 48.2031 27.0998 48.2031 25.7998V21.6998C48.2031 18.4998 50.3031 15.6998 53.2031 14.9998C55.4031 14.4998 57.7031 15.0998 59.3031 16.6998C60.9031 18.2998 61.6031 20.5998 61.1031 22.8998C60.5031 25.9998 57.7031 28.0998 54.6031 28.0998ZM52.8031 23.5998H54.6031C55.7031 23.5998 56.6031 22.8998 56.8031 21.9998C57.0031 21.1998 56.8031 20.4998 56.2031 19.9998C55.7031 19.4998 55.0031 19.2998 54.3031 19.4998C53.4031 19.6998 52.8031 20.6998 52.8031 21.7998V23.5998Z" />
              <path d="M9.6997 48.4002C7.9997 48.4002 6.2997 47.7002 5.0997 46.5002C3.4997 44.9002 2.7997 42.6002 3.2997 40.3002C3.9997 37.4002 6.6997 35.2002 9.8997 35.2002H13.9997C15.1997 35.2002 16.2997 36.2002 16.2997 37.5002V41.6002C16.2997 44.8002 14.1997 47.6002 11.2997 48.3002C10.6997 48.3002 10.1997 48.4002 9.6997 48.4002ZM9.8997 39.7002C8.7997 39.7002 7.8997 40.4002 7.6997 41.3002C7.4997 42.1002 7.6997 42.8002 8.2997 43.3002C8.7997 43.8002 9.4997 44.0002 10.1997 43.8002C11.0997 43.6002 11.6997 42.6002 11.6997 41.5002V39.7002H9.8997Z" />
              <path d="M43.3008 62.2004C42.8008 62.2004 42.3008 62.1004 41.8008 62.0004C38.9008 61.3004 36.8008 58.5004 36.8008 55.3004V51.2004C36.8008 50.0004 37.8008 48.9004 39.1008 48.9004H43.2008C46.4008 48.9004 49.1008 51.0004 49.8008 54.0004C50.3008 56.3004 49.7008 58.6004 48.0008 60.2004C46.7008 61.6004 45.0008 62.2004 43.3008 62.2004ZM41.3008 53.6004V55.4004C41.3008 56.5004 42.0008 57.5004 42.8008 57.7004C43.5008 57.9004 44.2008 57.7004 44.7008 57.2004C45.2008 56.7004 45.4008 55.9004 45.3008 55.2004C45.1008 54.3004 44.1008 53.6004 43.1008 53.6004H41.3008Z" />
            </svg>
            <h3 class="font-semibold text-xl text-[#E0E0E0]">
              Gulcose Level
            </h3>
            <p class="text-xl font-bold tracking-wider text-[#5AC0BC]">
              89-72
            </p>
            <!-- <div class="mt-2 w-2/5 bg-blue-400 h-2 rounded"></div> -->
          </div>
          <div class="w-56 p-4 space-y-4 rounded-md shadow-2xl hover:cursor-pointer hover:shadow-xl border border-[#146964] hover:border-[#189899]">

            <!-- Generator: Adobe Illustrator 22.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg fill="#E0E0E0" width="24" height="24" version="1.1" id="lni_lni-heart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background: new 0 0 64 64" xml:space="preserve">
              <g>
                <path d="M32,59c-1.3,0-2.6-0.5-3.6-1.4c-2.3-2-4.4-3.8-6.3-5.4c-5.7-4.9-10.7-9-14.2-13.2c-4.1-5-6.1-9.7-6.1-15
		c0-5.1,1.8-9.9,5-13.4C10.1,7,14.7,5,19.6,5c3.7,0,7.2,1.2,10.2,3.5c0.8,0.6,1.5,1.2,2.2,2c0.7-0.7,1.4-1.4,2.2-2
		c3-2.3,6.4-3.5,10.2-3.5c5,0,9.5,2,12.8,5.6c3.3,3.5,5,8.3,5,13.4c0,5.3-1.9,10-6.1,15c-3.5,4.2-8.5,8.4-14.2,13.2
		c-1.9,1.6-4.1,3.5-6.4,5.4C34.6,58.5,33.3,59,32,59z M19.6,9.5c-3.7,0-7.1,1.5-9.6,4.1C7.6,16.3,6.3,20,6.3,24c0,4.1,1.6,8,5,12.1
		c3.3,3.9,8.1,8,13.6,12.7c1.9,1.6,4.1,3.5,6.4,5.5c0.4,0.3,1,0.3,1.4,0c2.3-2,4.5-3.8,6.4-5.5C44.7,44,49.5,40,52.7,36.1
		c3.4-4.1,5-8,5-12.1c0-4-1.4-7.7-3.8-10.3C51.4,11,48,9.5,44.4,9.5c-2.7,0-5.2,0.9-7.4,2.5c-0.9,0.7-1.7,1.5-2.5,2.4
		c-0.6,0.7-1.5,1.2-2.5,1.2s-1.8-0.4-2.5-1.2c-0.8-0.9-1.6-1.7-2.5-2.4C24.9,10.4,22.4,9.5,19.6,9.5z" />
              </g>
            </svg>

            <h3 class="font-semibold text-xl text-[#E0E0E0]">Heart Rate</h3>
            <p class="text-xl font-bold tracking-wider text-[#5AC0BC]">95</p>
            <!-- <div class="mt-2 w-2/5 bg-blue-400 h-2 rounded"></div> -->
          </div>
        </div>

        <!-- Tasks and Statistics -->
        <div class="mt-6 grid grid-cols-2 gap-6 mx-3">
          <!-- Tasks for today -->
          <div class="slider-container relative overflow-hidden w-[18.5rem]">
            <div class="available-hospital-wrapper flex transition-transform duration-500 w-max">
              <?php while ($row = $hospitals->fetch_assoc()) : ?>


                <div class="available-hospital-container rounded-lg shadow-2xl px-3 py-3 w-[18.5rem] border border-[#146964]">
                  <div class="flex justify-between items-center pb-4">
                    <h2 class="text-2xl text-[#5AC0BC] font-semibold">Today</h2>
                    <div class="arrow flex items-center gap-x-4">
                      <div class="left-arrow hover:cursor-pointer">
                        <svg fill="#5AC0BC" width="20" height="20" viewBox="0 0 64 64">
                          <path d="M56,29.8H13.3l17-17.3c0.9-0.9,0.9-2.3,0-3.2c-0.9-0.9-2.3-0.9-3.2,0l-20.7,21c-0.9,0.9-0.9,2.3,0,3.2l20.7,21
	c0.4,0.4,1,0.7,1.6,0.7c0.6,0,1.1-0.2,1.6-0.6c0.9-0.9,0.9-2.3,0-3.2L13.4,34.3H56c1.2,0,2.2-1,2.2-2.2C58.2,30.8,57.2,29.8,56,29.8
	z" />
                        </svg>
                      </div>
                      <div class="right-arrow hover:cursor-pointer">
                        <svg fill="#5AC0BC" width="20" height="20" viewBox="0 0 64 64">
                          <path d="M57.6,30.4l-20.7-21c-0.9-0.9-2.3-0.9-3.2,0c-0.9,0.9-0.9,2.3,0,3.2l16.8,17.1H8c-1.2,0-2.2,1-2.2,2.2s1,2.3,2.2,2.3h42.7
	l-17,17.3c-0.9,0.9-0.9,2.3,0,3.2c0.4,0.4,1,0.6,1.6,0.6c0.6,0,1.2-0.2,1.6-0.7l20.7-21C58.5,32.7,58.5,31.3,57.6,30.4z" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="divide-y space-y-4 divide-dashed divide-slate-500">
                    <div class="hospital-info flex justify-between items-center mt-4">
                      <div class="hospital-img">
                        <img src="assets/birhospital.jpg" alt="Profile" class="rounded-lg size-24 object-cover" />
                      </div>
                      <div class="hospital-name-address mr-4">
                        <h2 class="text-lg font-semibold text-[#E0E0E0]"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="location text-xs text-gray-400"><?php echo htmlspecialchars($row['address']); ?></p>
                        <div class="time-duration mt-3 gap-x-2 flex items-center">
                          <svg fill="#5AC0BC" width="18" height="18" viewBox="0 0 64 64">
                            <path d="M54.6,42.5h-7c-3.3,0-6.2,2.1-7.2,5.1h-21c-3.7,0-6.7-3-6.7-6.7s3-6.7,6.7-6.7h25.3c6.2,0,11.2-5,11.2-11.2
	s-5-11.2-11.2-11.2H24.1c0-4.2-3.5-7.6-7.7-7.6h-7c-4.2,0-7.7,3.4-7.7,7.7v1.9c0,4.2,3.4,7.7,7.7,7.7h7c3.3,0,6.2-2.1,7.2-5.1h21
	c3.7,0,6.7,3,6.7,6.7s-3,6.7-6.7,6.7H19.3c-6.2,0-11.2,5-11.2,11.2s5,11.2,11.2,11.2h20.6c0,4.2,3.5,7.6,7.7,7.6h7
	c4.2,0,7.7-3.4,7.7-7.7v-1.9C62.2,45.9,58.8,42.5,54.6,42.5z M19.6,13.8c0,1.8-1.4,3.2-3.2,3.2h-7c-1.8,0-3.2-1.4-3.2-3.2V12
	c0-1.8,1.4-3.2,3.2-3.2h7c1.8,0,3.2,1.4,3.2,3.2V13.8z M57.8,52c0,1.8-1.4,3.2-3.2,3.2h-7c-1.8,0-3.2-1.4-3.2-3.2v-1.9
	c0-1.8,1.4-3.2,3.2-3.2h7c1.8,0,3.2,1.4,3.2,3.2V52z" />
                          </svg>
                          <span class="text-xs text-[#5AC0BC]">10 minutes</span>
                        </div>
                      </div>
                    </div>
                    <div class="doctor-info-and-appointment py-4 ">
                      <div class="doc-info flex justify-around items-center">
                        <div class="doctor-avatar">
                          <img class="h-12 w-12 rounded-full ring-2 ring-white" src="assets/doctors/doc1.jpg" alt="doctor-avatar" />
                        </div>
                        <div class="doctor-name-and-department mr-4">
                          <div class="doc-name font-semibold text-md tracking-wider text-[#E0E0E0]">Dr. Ramesh Koirala</div>
                          <div class="doc-department text-xs text-gray-400">H.O.D. Surgery</div>
                        </div>
                      </div>
                      <div class="appointment-info pt-8">
                        <h2 class="text-lg font-semibold text-center text-[#5AC0BC] tracking-wider">Scheduled Appointment</h2>
                        <div class="w-14 h-[2px] rounded-lg bg-blue-400 mt-1 ml-8"></div>
                        <div class="date-and-time flex items-center justify-around mt-3 font-semibold">
                          <div class="date">
                            <h2 class="text-gray-300">Date</h2>
                            <p class="text-[15px] text-[#5AC0BC]">2081-04-04</p>
                          </div>
                          <div class="time">
                            <h2 class="text-gray-300">Time</h2>
                            <p class="text-[15px] text-[#5AC0BC]">8:30 AM</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>


          <!-- Statistics -->
          <div class="p-6 rounded-lg shadow-xl border border-[#146964]">
            <h2 class="text-2xl text-[#5AC0BC] font-semibold">Statistics</h2>
            <div class="mt-4 space-y-4 text-[#E0E0E0]">
              <div class="flex items-center justify-between">
                <span>Tracked time</span>
                <span>28 h</span>
              </div>
              <div class="flex items-center justify-between">
                <span>Total CheckUps</span>
                <span>18</span>
              </div>
              <div class="flex items-center justify-between">
                <span>New edications</span>
                <span>-</span>
              </div>
              <div class="flex items-center justify-between">
                <span></span>
                <span>$9.99 p/m</span>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');
    const wrapper = document.querySelector('.available-hospital-wrapper');
    let currentIndex = 0;

    const containerWidth = 300; // Width of each container

    const slideLeft = () => {
      if (currentIndex > 0) {
        currentIndex--;
        wrapper.style.transform = `translateX(-${currentIndex * containerWidth}px)`;
        console.log('Sliding left to index:', currentIndex); // Debugging log
      } else {
        console.log('Cannot slide left, at start'); // Debugging log
      }
    };

    const slideRight = () => {
      if (currentIndex < wrapper.children.length - 1) {
        currentIndex++;
        wrapper.style.transform = `translateX(-${currentIndex * containerWidth}px)`;
      }
      console.log(currentIndex);
    };
    console.log(currentIndex);

    leftArrow.addEventListener('click', slideLeft);
    rightArrow.addEventListener('click', slideRight);
  });
</script>

</html>