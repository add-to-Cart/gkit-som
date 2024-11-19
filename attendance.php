<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Section -->
            <div class="lg:col-span-8">

                <!-- break -->

                <div class="bg-white rounded-md shadow-lg p-8 mb-4">

                    <h2 class="text-2xl font-medium text-gray-900 mb-4">Class Record</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-6 mb-4">
                        <!-- Search Input -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="search-student" class="block text-sm font-medium text-gray-800 mb-2">Search</label>
                            <div class="relative">
                                <input type="search" id="search-student" class="block w-full p-3 pl-10 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600" placeholder="Search Student" required>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 16.5a6 6 0 110-12 6 6 0 010 12z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Date Picker -->
                        <div class="col-span-1">
                            <label for="attendance_date_filter" class="block text-sm font-medium text-gray-800 mb-2">Date:</label>
                            <input type="date" id="attendance_date_filter" class="block w-full p-3 border border-gray-300 rounded-lg text-gray-900 focus:ring-blue-600 focus:border-blue-600">
                        </div>

                        <!-- Filter Dropdown -->
                        <div class="col-span-1">
                            <label for="filter" class="block text-sm font-medium text-gray-800 mb-2">Filter</label>
                            <select id="filter" class="block w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                            </select>
                        </div>
                    </div>




                    <!-- break -->

                    <!-- Student Table -->
                    <div class="flex gap-10">
                        <h5 class="font-medium text-green-600 mb-4">Total Present: <span id="totalPresentContainer"></span></h5>
                        <h5 class=" font-medium text-red-600 mb-4">Total Absent: <span id="totalAbsentContainer"></span></h5>
                    </div>

                    <div class="overflow-auto border border-gray-200 rounded-lg max-h-[400px]">

                        <table id="attendanceRecordTable" class="min-w-full divide-y divide-gray-200 overflow-auto">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Student Number</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Time-In</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                <tr class="hover:bg-gray-50">

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Follow-Up Section -->
                <div class="bg-white rounded-md shadow-lg p-8">
                    <div class="flex items-center justify-between my-8">
                        <h2 class="text-xl font-semibold text-red-600">Students for Follow-Up</h2>
                        <div class="relative w-72"> <!-- Limited width for the input to avoid it stretching too far -->
                            <input type="text" id="classTimes" class="block w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600" placeholder="Enter class times" required autocomplete="off">
                        </div>
                    </div>
                    <div class="overflow-auto border border-gray-200 rounded-lg max-h-[400px]">
                        <table id="followUpTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Student Number</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!-- Right Section -->
            <div class="lg:col-span-4 rounded-md mb-auto overflow-auto max-h-screen">

                <div class="flex items-center justify-between bg-white shadow-md rounded-md p-8 mb-4">
                    <span class="text-xl font-semibold text-gray-700">Post Meeting</span>
                    <button id="postMeetBtn" class="flex items-center gap-2 bg-yellow-400 text-red-900 font-semibold py-2 px-4 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-md transition-all duration-200 ease-in-out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New
                    </button>
                </div>


                <div class="bg-white shadow-md rounded-md p-8">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Attendance Form</h2>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2">
                            <label for="attendance_form_date" class="text-sm font-medium text-gray-800">Date:</label>
                            <input type="date" id="attendance_form_date" class="p-2 border border-gray-300 rounded-lg text-gray-900 focus:ring-blue-600 focus:border-blue-600">
                        </div>
                        <div id="clock" class="text-lg font-medium text-red-600"></div>
                    </div>
                    <div class="relative mb-5">
                        <input type="search" id="search-form-attendance" class="block w-full p-3 pl-10 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600" placeholder="Search Student" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 16.5a6 6 0 110-12 6 6 0 010 12z" />
                            </svg>
                        </div>
                    </div>
                    <form id="attendanceForm">
                        <ul id="studentContainer" class="divide-y divide-gray-200 overflow-auto max-h-[400px] mb-5"></ul>
                        <button class="flex items-center justify-center gap-2 bg-yellow-400 text-red-900 font-semibold py-2 px-4 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-md transition-all duration-200 ease-in-out w-full">
                            Submit
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Entering Meeting Link -->
    <div id="linkModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-md shadow-lg p-6 w-80">
            <h2 class="text-center text-lg font-semibold text-gray-800 mb-4">Enter the Meeting Link</h2>
            <div class="mb-4">
                <label for="meetingLink" class="block text-sm font-medium text-gray-800 mb-2">Link</label>
                <input type="text" id="meetingLink" placeholder="Enter link here" class="block w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600">
                <!-- Error message placeholder -->
                <div id="errorMessage" class="text-red-500 text-sm mt-2 hidden"></div>
            </div>
            <div class="flex justify-between gap-2 mt-6">
                <button id="cancelLinkBtn" class="w-full bg-gray-300 text-gray-700 font-semibold py-2 rounded-lg hover:bg-gray-400 transition duration-200">
                    Cancel
                </button>
                <button id="submitLinkBtn" class="w-full bg-yellow-400 text-red-900 font-semibold py-2 rounded-lg hover:bg-yellow-500 transition duration-200">
                    Post
                </button>
            </div>
        </div>
    </div>


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

            $('#postMeetBtn').on('click', function() {
                $('#linkModal').toggleClass('hidden');

            })
            $('#cancelLinkBtn').on('click', function() {
                $('#linkModal').toggleClass('hidden');

            })

            $('#submitLinkBtn').on('click', function() {
                let meetingLink = $('#meetingLink').val();
                let errorMessage = $('#errorMessage');

                // Regular expression for URL validation
                let urlPattern = /^(https?:\/\/)?([a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+)(:[0-9]+)?(\/.*)?$/;

                // Validate meeting link
                if (!urlPattern.test(meetingLink)) {
                    errorMessage.text('Please enter a valid URL.').removeClass('hidden'); // Show error message
                    return; // Stop the function if the link is invalid
                } else {
                    errorMessage.addClass('hidden'); // Hide error message if URL is valid
                }

                // If valid, proceed with AJAX request
                $.ajax({
                    url: 'submit_meeting_link.php',
                    type: 'POST',
                    data: {
                        meetingLink: meetingLink
                    },
                    success: function(response) {
                        console.log('Meeting link submitted successfully.');
                        $('#linkModal').addClass('hidden'); // Close modal on success
                        // Initial check when the page loads
                        checkActiveMeeting();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        errorMessage.text('Error submitting the meeting link. Please try again.').removeClass('hidden');
                    }
                });
            });




            // Fetch function with optional search term
            function fetchAttendanceForm(searchTerm = '') {
                $.ajax({
                    url: 'fetch_student.php', // URL of your PHP file
                    type: 'GET',
                    data: {
                        search: searchTerm
                    }, // Send the search term to PHP
                    success: function(data) {
                        let students = JSON.parse(data);
                        let htmlContent = '';
                        students.forEach(student => {
                            htmlContent += `
                    <li class="flex justify-between items-center py-3 hover:bg-gray-50">
                        <span id="formStudentNumber" class="text-gray-800">${student.STUDENT_NUMBER}</span>
                        <span id="formStudentName" class="text-gray-800">${student.NAME}</span>
                        <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded hover:cursor-pointer">
                    </li>`;
                        });
                        $('#studentContainer').html(htmlContent);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }



            // Form submission handler
            $('#attendanceForm').on('submit', function(e) {
                e.preventDefault();

                // Ensure attendance date is selected
                const attendanceDate = $('#attendance_form_date').val();
                if (!attendanceDate) {
                    alert('Please select an attendance date.');
                    return;
                }

                // Collect attendance data and check if any student is selected
                const attendanceData = [];
                $('#studentContainer li').each(function() {
                    const studentNumber = $(this).find('#formStudentNumber').text();
                    const studentName = $(this).find('#formStudentName').text();
                    const studentCheckbox = $(this).find('input[type="checkbox"]');
                    const attendanceStatus = studentCheckbox.is(':checked') ? '1' : '0'; // 1 for present, 0 for absent
                    const timeIn = $('#clock').text(); // Get current time for TIME_IN

                    attendanceData.push({
                        studentNumber: studentNumber,
                        name: studentName,
                        attendance: attendanceStatus,
                        timeIn: timeIn,
                        dateAttended: attendanceDate
                    });
                });

                // Check if any student has been selected for attendance
                if (attendanceData.length === 0 || !attendanceData.some(entry => entry.attendance === '1')) {
                    alert('Please select at least one student to log attendance.');
                    return;
                }

                // Submit the data to PHP for insertion
                $.ajax({
                    url: 'submit_attendance.php', // PHP file to handle insertion
                    type: 'POST',
                    data: {
                        attendanceData: JSON.stringify(attendanceData)
                    },
                    success: function(response) {
                        alert('Attendance data saved successfully.');
                        fetchAttendanceRecord('', '', 'present');
                        console.log('Attendance data:', attendanceData);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving attendance data:', error);
                    }
                });
            });





            function updateAttendanceCounts(studentNumber) {
                $.ajax({
                    url: 'fetch_attendance_count.php', // New PHP file for fetching both counts
                    type: 'GET',
                    data: {
                        student_number: studentNumber
                    },
                    success: function(data) {
                        const counts = JSON.parse(data);
                        $('#totalAbsentContainer').text(counts.absent_count);
                        $('#totalPresentContainer').text(counts.present_count);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching attendance counts:', error);
                    }
                });
            }

            // Function to fetch and display attendance records
            function fetchAttendanceRecord(searchTerm = '', date = '', filter = 'present') {
                $.ajax({
                    url: 'fetch_attendance.php', // PHP file to fetch data
                    type: 'GET',
                    data: {
                        search: searchTerm,
                        date: date,
                        filter: filter
                    },
                    success: function(data) {
                        let students = JSON.parse(data);
                        let tableRows = '';

                        // Loop through each student and add to table
                        students.forEach(student => {
                            let status = student.ATTENDANCE == '1' ? 'Present' : 'Absent';
                            tableRows += `
                        <tr class="hover:bg-gray-50 hover:cursor-pointer">
                            <td class="px-4 py-2 text-sm text-gray-700">${student.STUDENT_NUMBER}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">${student.NAME}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">${status}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">${student.TIME_IN}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">${student.DATE_ATTENDED}</td>
                        </tr>`;
                        });

                        // Insert the table rows into the tbody of the table
                        $('#attendanceRecordTable tbody').html(tableRows);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }
            // Fetch follow-up students
            function analyzeAttendance(classTimeValue) {
                var totalClasses = parseInt(classTimeValue);

                // Ensure the input is valid
                if (isNaN(totalClasses) || totalClasses <= 0) {
                    alert("Please enter a valid number of class times.");
                    return;
                }

                // Calculate the 50% threshold
                var threshold = Math.ceil(totalClasses / 2);



                // Send data to PHP for processing
                $.ajax({
                    url: 'absent_analysis.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        totalClasses: totalClasses,
                        threshold: threshold
                    },
                    success: function(data) {
                        // Clear previous results in the table body
                        $('#followUpTable tbody').empty();

                        if (data.success && data.students.length > 0) {
                            // Loop through the students and insert them into the table
                            data.students.forEach(function(student) {
                                var row = `<tr>
                            <td class="px-4 py-2 text-sm text-gray-700">${student.STUDENT_NUMBER}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">${student.NAME}</td>
                        </tr>`;
                                $('#followUpTable tbody').append(row);
                            });
                        } else {
                            // If no students need follow-up
                            $('#followUpTable tbody').append('<tr><td colspan="2" class="px-4 py-2 text-sm text-gray-700 text-center">No students need follow-up.</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#followUpTable tbody').html('<tr><td colspan="2" class="px-4 py-2 text-sm text-gray-700 text-center">An error occurred. Please try again later.</td></tr>');
                    }
                });


            }

            function updateClock() {
                const now = new Date();
                const time = now.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                $('#clock').text(time);
            }

            // Event listener for row click to update counts
            $('#attendanceRecordTable').on('click', 'tr', function() {
                const studentNumber = $(this).find('td').first().text();
                updateAttendanceCounts(studentNumber);
            });

            // Event listeners for search, date, and filter inputs
            $('#search-student, #attendance_date_filter, #filter').on('input change', function() {
                let searchTerm = $('#search-student').val();
                let date = $('#attendance_date_filter').val();
                let filter = $('#filter').val();

                fetchAttendanceRecord(searchTerm, date, filter);
            });

            // Fetch data based on search input
            $('#search-form-attendance').on('input', function() {
                let searchTerm = $(this).val();
                fetchAttendanceForm(searchTerm);
            });
            $('#classTimes').on('input', function() {
                let classTimeValue = $(this).val();
                if (classTimeValue && !isNaN(classTimeValue)) { // Ensure it's a number
                    analyzeAttendance(classTimeValue);
                } else {
                    console.warn("Please enter a valid class time.");
                }
            });





















































            // Update clock every second
            setInterval(updateClock, 1000);

            updateClock(); // Initial call

            // Initial fetch of attendance data on page load
            fetchAttendanceForm('');

            // Initial data fetch with default filter as "present"
            fetchAttendanceRecord('', '', 'present');








        });
    </script>
</body>

</html>