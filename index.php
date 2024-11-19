<?php
session_start();

// Redirect to login.php if AccNumber is not set or empty
if (!isset($_SESSION['AccNumber']) || empty($_SESSION['AccNumber'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKITSOM - Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <header>
        <!-- Main Navigation Bar -->
        <nav class="flex items-center justify-between bg-gray-50 border-b border-gray-200 px-6 py-2 md:px-10">

            <!-- Left Side: Brand Name -->
            <div class="flex items-center space-x-2">
                <!-- Logo and Brand Name -->
                <a href="index.php" class="flex items-center space-x-2">
                    <img src="input/gkit-logo.png" alt="Gkit Logo" class="h-16 w-auto"> <!-- Logo with fixed height -->
                    <span class="text-xl font-black text-red-900">GKITSOM</span> <!-- Brand name with styling -->
                </a>
            </div>


            <div id="meetingDetails" class="hidden flex items-center space-x-2 bg-blue-50 p-2 rounded-md shadow-md max-w-2xl mx-auto">
                <div class="text-base font-medium text-gray-800">On Going Meeting</div>
                <span id="activeMeeting" class="ml-2 text-lg font-semibold text-green-600">Meeting Link</span>
                <button id="endMeetingBtn" class="ml-3 px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">End Meeting</button>
            </div>


            <!-- Right Side: Dropdown Menu -->
            <div class="relative">
                <!-- Dropdown Button -->
                <button id="dropdownButton" class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-semibold text-gray-900 transition duration-200 ease-in-out group">
                    <span class="text-gray-900 group-hover:text-yellow-500 transition duration-200 ease-in-out">
                        <?php echo htmlspecialchars($_SESSION['AccNumber']); ?>

                        <?php echo htmlspecialchars($_SESSION['EmployeeName']); ?>
                    </span>
                    <svg class="h-5 w-5 text-gray-900 group-hover:text-yellow-500 transition duration-200 ease-in-out" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>


                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="absolute right-0 z-10 mt-2 w-56 hidden rounded-md bg-white shadow-lg ring-1 ring-black/5">
                    <div class="py-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out" role="menuitem">License</a>
                        <form method="POST" action="logout.php">
                            <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-200 ease-in-out">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Secondary Navigation for larger screens -->
        <nav class="hidden md:flex bg-red-900 border-t border-gray-200 py-3">
            <div class="max-w-screen-xl mx-auto">
                <ul class="flex items-center space-x-8 text-sm font-medium text-white">
                    <li><a href="#dashboard" class="hover:text-yellow-400 transition-colors duration-300 nav-link" data-page="dashboard" aria-label="Go to Dashboard">Dashboard</a></li>
                    <li><a href="#manage-student" class="hover:text-yellow-400 transition-colors duration-300 nav-link" data-page="manage_student" aria-label="Manage Students">Manage Students</a></li>
                    <li><a href="#generate-id" class="hover:text-yellow-400 transition-colors duration-300 nav-link" data-page="generate_id" aria-label="Generate Student ID">Generate ID</a></li>
                    <li><a href="#attendance" class="hover:text-yellow-400 transition-colors duration-300 nav-link" data-page="attendance" aria-label="Attendance">Attendance</a></li>
                    <li><a href="#finance" class="hover:text-yellow-400 transition-colors duration-300 nav-link" data-page="finance" aria-label="Finance">Finance</a></li>
                </ul>
            </div>
        </nav>

        <!-- Mobile Menu Dropdown -->
        <nav id="mobile-menu" class="bg-gray-100 dark:bg-gray-800 p-4 space-y-4 hidden transition-all duration-300">
            <a href="#dashboard" class="block text-gray-900 dark:text-white hover:text-yellow-400 nav-link" data-page="dashboard" aria-label="Go to Dashboard">Dashboard</a>
            <a href="#manage-student" class="block text-gray-900 dark:text-white hover:text-yellow-400 nav-link" data-page="manage_student" aria-label="Manage Students">Manage Students</a>
            <a href="#generate-id" class="block text-gray-900 dark:text-white hover:text-yellow-400 nav-link" data-page="generate_id" aria-label="Generate Student ID">Generate ID</a>
            <a href="#view-printed-id" class="block text-gray-900 dark:text-white hover:text-yellow-400 nav-link" data-page="view_id" aria-label="View Printed ID">View Printed ID</a>
        </nav>
    </header>

    <main id="main-content" class="mt-5 px-4 md:px-8 lg:px-16">
        <!-- Dynamic content will be loaded here -->
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            // Function to check for active meetings
            function checkActiveMeeting() {
                $.ajax({
                    url: 'fetch_active_meeting.php', // Replace with the actual path to your PHP script
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // If there's an active meeting, show the meeting details div
                        if (response.status === "Ongoing" && response.link) {
                            $('#meetingDetails').removeClass('hidden');
                            $('#activeMeeting').html(response.link); // Insert the active link as HTML
                        } else {
                            // Hide the meeting details if there's no active meeting
                            $('#meetingDetails').addClass('hidden');
                        }
                    },
                    error: function() {
                        console.log("Error fetching meeting status.");
                    }
                });
            }

            // Initial check when the page loads
            checkActiveMeeting();

            // Set an interval to check the meeting status periodically
            setInterval(checkActiveMeeting, 60000); // Check every 60 seconds

            // End meeting button functionality
            $('#endMeetingBtn').on('click', function() {
                var meetingLink = $('#activeMeeting').text(); // Get the current meeting link from the page

                $.ajax({
                    url: 'end_meeting.php', // Replace with the PHP script to end the meeting
                    type: 'POST',
                    data: {
                        meetingLink: meetingLink
                    }, // Send the meeting link in the POST data
                    success: function(response) {
                        $('#meetingDetails').addClass('hidden'); // Hide the meeting details on end

                    },
                    error: function() {
                        console.log("Error ending meeting.");
                    }
                });
            });



            const dropdownButton = $('#dropdownButton');
            const dropdownMenu = $('#dropdownMenu');

            // Toggle Dropdown Menu
            dropdownButton.on('click', function(e) {
                e.stopPropagation(); // Prevent closing when clicking the button
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
                dropdownMenu.toggleClass('hidden');
            });

            // Close Dropdown when clicking outside
            $(document).on('click', function() {
                dropdownMenu.addClass('hidden');
                dropdownButton.attr('aria-expanded', 'false');
            });
            // Function to load content dynamically
            function loadContent(page) {
                $.ajax({
                    url: page + ".php",
                    method: "GET",
                    success: function(data) {
                        $('#main-content').html(data);
                    },
                    error: function() {
                        $('#main-content').html("<p>Error loading content</p>");
                    }
                });
            }

            // Check if there's a stored page and load it
            const lastPage = localStorage.getItem('lastPage') || 'dashboard'; // Default to 'dashboard'
            loadContent(lastPage);

            // Event listener for navigation links
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                loadContent(page);
                localStorage.setItem('lastPage', page); // Store the last page visited
                history.pushState(null, '', `#${page}`);
            });

            // Handle browser navigation (back/forward)
            $(window).on('popstate', function() {
                const page = location.hash.replace('#', '') || 'dashboard';
                loadContent(page);
            });

            // Mobile Menu Toggle
            $('#mobile-menu-button').on('click', function() {
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
                $('#mobile-menu').toggleClass('hidden');
            });
        });
    </script>
</body>

</html>