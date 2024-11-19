<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Student Form</title>
</head>

<body class="bg-gray-100">


    <div class="mx-5 p-4 md:py-6 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-10 gap-6">
        <!-- Left Sidebar/Table Section -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-4 md:col-span-2 ">
            <div class="flex justify-between items-center mb-4 gap-2">
                <!-- Search Box -->
                <div class="w-2/3">
                    <label for="search-student" class="text-sm font-medium text-gray-900">Search</label>
                    <div class="relative">
                        <input type="search" id="search-student" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Student" required />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="w-1/3">
                    <label for="filter" class="text-sm font-medium text-gray-900">Filter</label>
                    <select name="filter" id="filter" class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">Select All</option>
                        <option value="fp">For Printing</option>
                        <option value="wb">With Balance</option>
                    </select>
                </div>
            </div>
            <div class="rounded-lg overflow-auto overflow-x-hidden max-h-screen border border-gray-200">
                <table id="studentTable" class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">SNumber</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-500">Degree</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"></tbody>
                </table>
            </div>

        </div>

        <!-- Right Content/Form Section -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-6 md:col-span-2">
            <form id="studentForm" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="student_number" class="block text-gray-700 mb-1">Student Number</label>
                        <input type="text" id="student_number" name="student_number" class="block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="status" class="block text-gray-700 mb-1">Status</label>
                        <input type="text" id="status" name="status" class="block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="degree" class="block text-gray-700 mb-1">Degree</label>
                        <select id="degree" name="degree" class="block w-full p-2 border rounded-lg" required>
                            <option value="" disabled selected>Select Degree</option>
                            <option value="ASSOCIATE">ASSOCIATE</option>
                            <option value="BACHELOR">BACHELOR</option>
                            <option value="MASTERAL">MASTERAL</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="firstname" class="block text-gray-700">First Name</label>
                        <input type="text" id="firstname" name="firstname" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="middlename" class="block text-gray-700">Middle Name</label>
                        <input type="text" id="middlename" name="middlename" class="mt-1 block w-full p-2 border rounded-lg">
                    </div>
                    <div>
                        <label for="lastname" class="block text-gray-700">Last Name</label>
                        <input type="text" id="lastname" name="lastname" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="suffix" class="block text-gray-700">Suffix</label>
                        <input type="text" id="suffix" name="suffix" class="mt-1 block w-full p-2 border rounded-lg">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label for="gender" class="block text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="mt-1 block w-full p-2 border rounded-lg" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="birthdate" class="block text-gray-700">Birthdate</label>
                        <input type="date" id="birthdate" name="birthdate" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700">Address</label>
                        <textarea id="address" name="address" class="mt-1 block w-full p-2 border rounded-lg" required></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="contact" class="block text-gray-700">Contact</label>
                        <input type="text" id="contact" name="contact" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="church" class="block text-gray-700">Church</label>
                        <input type="text" id="church" name="church" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="pastor" class="block text-gray-700">Pastor</label>
                        <input type="text" id="pastor" name="pastor" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="ministry" class="block text-gray-700">Ministry</label>
                        <input type="text" id="ministry" name="ministry" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                    <div>
                        <label for="joined_date" class="block text-gray-700">Joined Date</label>
                        <input type="date" id="joined_date" name="joined_date" class="mt-1 block w-full p-2 border rounded-lg" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label for="e_name" class="block text-gray-700">E.Contact Name</label>
                        <input type="text" id="e_name" name="e_name" class="mt-1 block w-full p-2 border rounded-lg">
                    </div>
                    <div>
                        <label for="e_relationship" class="block text-gray-700">E.Contact Relationship</label>
                        <input type="text" id="e_relationship" name="e_relationship" class="mt-1 block w-full p-2 border rounded">
                    </div>
                    <div>
                        <label for="e_name" class="block text-gray-700">Emergency Contact</label>
                        <input type="text" id="e_contact" name="e_contact" class="mt-1 block w-full p-2 border rounded-lg">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label for="balance" class="block text-gray-700">Balance</label>
                        <input type="text" id="balance" name="balance" class="mt-1 block w-full p-2 border rounded-lg text-red-500">
                    </div>
                    <div>
                        <label for="id_balance" class="block text-gray-700">ID Balance</label>
                        <input type="text" id="id_balance" name="id_balance" class="mt-1 block w-full p-2 border rounded-lg text-red-500">
                    </div>
                    <div>
                        <label for="total_payment" class="block text-gray-700">Total Payment</label>
                        <input type="text" id="total_payment" name="total_payment" class="mt-1 block w-full p-2 border rounded-lg text-green-500">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-4">
                    <!-- Enroll Button -->
                    <button type="button" id="enrollBtn" class="w-full md:w-auto bg-yellow-400 text-red-900 font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-500 transition duration-300">
                        Enroll
                    </button>

                    <!-- Update Button (adjusted to match theme) -->
                    <button type="button" id="updateBtn" class="w-full md:w-auto bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                        Update
                    </button>

                    <!-- Clear Button (adjusted to match theme) -->
                    <button type="reset" class="w-full md:w-auto bg-red-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-600 transition duration-300">
                        Clear
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <div class="flex justify-center mb-4">
                <div class="bg-green-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <h2 class="text-center text-lg font-semibold text-gray-800">Form submitted successfully.</h2>
            <p id="modalMessage" class="text-center text-gray-500 mt-2"></p>
            <div class="mt-6">
                <button id="closeModal" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <div class="flex justify-center mb-4">
                <div class="bg-red-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9S7.03 3 12 3s9 4.03 9 9z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-center text-lg font-semibold text-gray-800">Form submission failed. Please try again.</h2>
            <p id="errorMessage" class="text-center text-gray-500 mt-2"></p>
            <div class="mt-6">
                <button id="closeErrorModal" class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition duration-200">
                    Close
                </button>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function showModal(message) {
                $('#modalMessage').text(message);
                $('#successModal').removeClass('hidden');
            }


            // Function to show error modal with custom message
            function showErrorModal(message) {
                $('#errorMessage').text(message);
                $('#errorModal').removeClass('hidden');
            }

            // Hide modal when the close button is clicked
            $('#closeModal').click(function() {
                $('#successModal').addClass('hidden');
            });

            // Hide error modal when the close button is clicked
            $('#closeErrorModal').click(function() {
                $('#errorModal').addClass('hidden');
            });

            // Fetch and display student data
            function getStudents() {
                let search = $('#search-student').val();
                let filter = $('#filter').val();

                $.ajax({
                    url: 'fetch_student.php',
                    type: 'GET',
                    data: {
                        search: search,
                        filter: filter
                    },
                    dataType: 'json',
                    success: function(data) {
                        let output = '';
                        $.each(data, function(index, student) {
                            output += `<tr class="hover:bg-blue-50 hover:cursor-pointer" data-student-number="${student.STUDENT_NUMBER}">
                        <td class="px-4 py-2 text-gray-700">${student.STUDENT_NUMBER}</td>
                        <td class="px-4 py-2 text-gray-700">${student.NAME}</td>
                        <td class="px-4 py-2 text-gray-700">${student.DEGREE}</td>
                    </tr>`;
                        });
                        $('#studentTable tbody').html(output);

                        // Add click event to each row after rendering
                        $('#studentTable tbody tr').click(function() {
                            let studentNumber = $(this).data('student-number');
                            loadStudentData(studentNumber);
                        });
                    }
                });
            }

            function fetchStudents(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let output = '';
                        $.each(data, function(index, student) {
                            output += `<tr class="hover:bg-blue-50 hover:cursor-pointer" data-student-number="${student.STUDENT_NUMBER}">
                    <td class="px-4 py-2 text-gray-700">${student.STUDENT_NUMBER}</td>
                    <td class="px-4 py-2 text-gray-700">${student.NAME}</td>
                    <td class="px-4 py-2 text-gray-700">${student.DEGREE}</td>
                </tr>`;
                        });
                        $('#studentTable tbody').html(output);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                        $('#studentTable tbody').html('<tr><td colspan="3">Error fetching data.</td></tr>');
                    }
                });
            }

            function getPrintableStudents() {
                fetchStudents('fetch_student_fp.php');
            }

            function getWithBalance() {
                fetchStudents('fetch_student_wb.php');
            }


            $('#filter').change(function() {
                let filterValue = $(this).val();
                if (filterValue === 'fp') {
                    getPrintableStudents();
                } else if (filterValue === 'wb') {
                    getWithBalance();
                } else {
                    getStudents(); // Default for 'Select All'
                }
            });



            // Function to load student data into the form
            function loadStudentData(studentNumber) {
                $.ajax({
                    url: 'display_table.php', // Make sure to create this PHP file
                    type: 'GET',
                    data: {
                        student_number: studentNumber
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (!data.error) {
                            // Populate form fields with the fetched data
                            $('#student_number').val(data.STUDENT_NUMBER);
                            $('#status').val(data.STATUS);
                            $('#degree').val(data.DEGREE);
                            $('#firstname').val(data.FIRSTNAME);
                            $('#middlename').val(data.MIDDLENAME);
                            $('#lastname').val(data.LASTNAME);
                            $('#suffix').val(data.SUFFIX);
                            $('#gender').val(data.GENDER);
                            $('#birthdate').val(data.BIRTHDATE);
                            $('#address').val(data.ADDRESS);
                            $('#contact').val(data.CONTACT);
                            $('#email').val(data.EMAIL);
                            $('#church').val(data.CHURCH);
                            $('#pastor').val(data.PASTOR);
                            $('#ministry').val(data.MINISTRY);
                            $('#joined_date').val(data.DATE_IN_GKMCC);
                            $('#e_name').val(data.E_NAME);
                            $('#e_relationship').val(data.E_RELATIONSHIP);
                            $('#e_contact').val(data.E_CONTACT);
                            $('#balance').val(data.BALANCE);
                            $('#id_balance').val(data.ID_BALANCE);
                            $('#total_payment').val(data.TOTAL_PAYMENT);
                        } else {
                            alert(data.error);
                        }
                    },
                    error: function() {
                        alert('Failed to fetch student data.');
                    }
                });
            }

            // Optionally, add event listeners for search and filter fields
            $('#search-student, #filter').on('input change', function() {
                getStudents();
            });

            // Enroll new student
            $('#enrollBtn').click(function() {
                // Clear previous error messages
                $('.error').remove();

                // Flag to track if the form is valid
                let isValid = true;

                // Check each required field
                $('#studentForm input[required], #studentForm select[required], #studentForm textarea[required]').each(function() {
                    if (!$(this).val()) {
                        // If the field is empty, display an error message
                        $(this).addClass('border-red-500');
                        $(this).after('<span class="error text-red-500">This field is required</span>');
                        isValid = false;
                    } else {
                        // If the field has a value, remove any previous error indication
                        $(this).removeClass('border-red-500');
                        $(this).next('.error').remove();
                    }
                });

                // If the form is valid, proceed with the AJAX request
                if (isValid) {
                    let formData = $('#studentForm').serialize();

                    $.ajax({
                        url: 'enroll_student.php', // This script should handle inserting new student records
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                showModal('Student enrolled successfully!');
                                $('#studentForm')[0].reset();
                                getStudents();
                            } else {
                                // Show a modal for duplicate entry
                                showErrorModal(response.message); // 'Student already exists with the same number or name.'
                            }
                        },
                        error: function() {
                            showErrorModal('Error enrolling student. Please try again.');
                        }
                    });
                } else {
                    showErrorModal('Please fill in all required fields.');
                }
            });




            $('#updateBtn').click(function() {
                // Clear previous error messages
                $('.error').remove();

                // Flag to track if the form is valid
                let isValid = true;

                // Check each required field
                $('#studentForm input[required], #studentForm select[required], #studentForm textarea[required]').each(function() {
                    if (!$(this).val()) {
                        // If the field is empty, display an error message
                        $(this).addClass('border-red-500');
                        $(this).after('<span class="error text-red-500">This field is required</span>');
                        isValid = false;
                    } else {
                        // If the field has a value, remove any previous error indication
                        $(this).removeClass('border-red-500');
                        $(this).next('.error').remove();
                    }
                });

                // If the form is valid, proceed with the AJAX request
                if (isValid) {
                    let formData = $('#studentForm').serialize();

                    $.ajax({
                        url: 'update_student.php', // This script should handle updating student records
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            showModal('Student information updated!');
                            $('#studentForm')[0].reset();
                            getStudents();
                        },
                        error: function() {
                            showErrorModal('Error updating student. Please try again.');
                        }
                    });
                } else {
                    showErrorModal('Please fill in all required fields.');
                }
            });





            getStudents();


        });
    </script>

</body>

</html>