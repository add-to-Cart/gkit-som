<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKITSOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .perspective {
            perspective: 1000px;
        }

        .flip-card {
            transform-style: preserve-3d;
            transition: transform 0.6s;
            width: 16rem;
            height: 24rem;
            margin: 1rem;
        }

        .flip-card:hover {
            transform: rotateY(180deg);
        }

        .flip-card .front,
        .flip-card .back {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            backface-visibility: hidden;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .flip-card .back {
            transform: rotateY(180deg);
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin-bottom: 2rem;
        }

        .search-container input[type="search"] {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #ffffff;
            color: #111827;
        }

        .search-container svg {
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex flex-col items-center min-h-screen p-4">

        <div class="search-container">
            <input type="search" id="searchID" placeholder="Search by name or student number" required autocomplete="off" />
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>

        <div class="flex flex-wrap justify-center items-center w-full" id="cardContainer">
            <!-- Flip cards will be dynamically inserted here by jQuery -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchStudents(query = '') {
                $.ajax({
                    url: 'fetch_output.php',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#cardContainer').empty();
                        if (data && !data.error) {
                            data.forEach(student => {
                                const studentNumber = student.STUDENT_NUMBER;
                                const cardHtml = `
                                    <div class="perspective">
                                        <div class="flip-card">
                                            <!-- Front Side -->
                                            <div class="front">
                                                <img src="output/${studentNumber}_front.png" alt="Front Image" class="w-full h-full object-cover rounded-lg">
                                            </div>
                                            <!-- Back Side -->
                                            <div class="back">
                                                <img src="output/${studentNumber}_back.png" alt="Back Image" class="w-full h-full object-cover rounded-lg">
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $('#cardContainer').append(cardHtml);
                            });
                        } else {
                            $('#cardContainer').html('<p>No students found with the given criteria.</p>');
                        }
                    },
                    error: function() {
                        $('#cardContainer').html('<p>An error occurred while fetching data.</p>');
                    }
                });
            }

            // Initial fetch without query
            fetchStudents();

            // Fetch on search input change
            $('#searchID').on('input', function() {
                const query = $(this).val();
                fetchStudents(query);
            });
        });
    </script>
</body>

</html>