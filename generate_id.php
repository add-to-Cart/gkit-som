<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-10 gap-6 mx-5 p-4 md:py-6 max-h-screen">
        <!-- Left Sidebar/Table Section -->
        <div class="bg-white rounded-md shadow-lg p-8 lg:col-span-4 md:col-span-2 gap-6 flex flex-col items-center space-y-6 overflow-hidden max-h-screen">
            <!-- View ID Button with Icon -->
            <a href="#view_id" class="flex items-center space-x-2 px-5 py-2 text-blue-500 hover:text-blue-600 bg-blue-50 hover:bg-blue-100 font-semibold rounded-full transition-all duration-200 shadow-sm" data-page="view_id" aria-label="View ID">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.293 6.707a1 1 0 011.414 0L15 11l-4.293 4.293a1 1 0 01-1.414-1.414L11.586 12H3a1 1 0 110-2h8.586L9.293 8.121a1 1 0 010-1.414z" />
                </svg>
                <span>View ID</span>
            </a>

            <!-- Image Section with Border and Shadow -->
            <div class="flex space-x-6 mb-6">
                <img class="rounded-lg w-36 h-56 border border-gray-200 shadow-md" src="input/som_backid.jpg" alt="Back ID Image">
                <img class="rounded-lg w-36 h-56 border border-gray-200 shadow-md" src="input/som_frontid.jpg" alt="Front ID Image">
            </div>

            <!-- Current Printed Count Section -->
            <div class="text-center space-y-2">
                <h1 class="text-lg font-semibold text-gray-700">Current Printed</h1>
                <div class="text-3xl font-bold text-blue-600">
                    <?php echo isset($_SESSION['student_count_no_balance']) ? $_SESSION['student_count_no_balance'] : 0; ?>
                </div>
            </div>
        </div>


        <!-- Right Content/Form Section -->
        <div class="bg-white rounded-md shadow-md p-6 lg:col-span-6 md:col-span-2 max-h-screen overflow-auto">
            <!-- Button Section -->
            <div class="flex mb-6">
                <button id="printBtn" class="px-6 py-3 bg-yellow-400 text-red-900 font-semibold py-2 px-4 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-md transition-all duration-200 ease-in-out w-full">
                    Print IDs
                </button>
            </div>

            <!-- Image Section -->
            <div id="printContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-6 overflow-auto max-h-screen"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // When the print button is clicked
            $('#printBtn').on('click', function() {
                $.ajax({
                    url: 'fetch_for_print.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(students) {
                        students.forEach(function(student) {
                            var middleInitial = student.MIDDLENAME.charAt(0).toUpperCase();
                            var studentId = student.STUDENT_NUMBER;

                            // Create front ID HTML
                            var frontIDHtml = `
                                <div id="${studentId}-front" class="mb-5" style="width: 772px; height: 1199px; position: relative; background: white">
                                    <img style="width: 772px; height: 1199px; left: 0px; top: 0px; position: absolute" src="input/som_frontid.jpg" />
                                    <img style="width: 218px; height: 218px; left: 13px; top: 22px; position: absolute" src="input/qr/${studentId}.png" onerror="this.onerror=null; this.src='input/default.jpg';"/>
                                    <img style="width: 256px; height: 256px; left: 377px; top: 551px; position: absolute" src="input/photo/${studentId}_photo.jpg" onerror="this.onerror=null; this.src='input/default.jpg';"/>
                                    <div style="left: 371px; top: 496px; position: absolute; color: white; font-size: 30px; font-family: Luxurious Roman; font-weight: 400; word-wrap: break-word">BATCH 2024 - 2025</div>
                                    <div style="left: 37px; top: 855px; position: absolute; color: white; font-size: 45px; font-family: Roboto; font-weight: 700; word-wrap: break-word">${student.FIRSTNAME} ${middleInitial}. ${student.LASTNAME}</div>
                                    <div style="left: 37px; top: 900px; position: absolute; color: white; font-size: 30px; font-family: Luxurious Roman; font-weight: 400; word-wrap: break-word">ASSOCIATE IN CHRISTIAN LEADERSHIP</div>
                                    <div style="left: 37px; top: 945px; position: absolute; color: white; font-size: 30px; font-family: Luxurious Roman; font-weight: 400; word-wrap: break-word">${student.CHURCH}</div>
                                    <img style="width: 256px; height: 97px; left: 377px; top: 1036px; position: absolute" src="input/signature/${studentId}_sig.jpg" onerror="this.onerror=null; this.src='input/default.jpg';"/>
                                    <div style="left: 35px; top: 240px; position: absolute; color: black; font-size: 30px; font-family: Roboto; font-weight: 400; word-wrap: break-word">${studentId}</div>
                                </div>
                            `;

                            // Create back ID HTML
                            var backIDHtml = `
                                <div id="${studentId}-back" class="mb-5" style="width: 772px; height: 1199px; position: relative; background: white">
                                    <img style="width: 772px; height: 1199px; left: 0px; top: 0px; position: absolute" src="input/som_backid.jpg" />
                                    <div style="left: 162px; top: 549px; position: absolute; color: black; font-size: 30px; font-family: Roboto; font-weight: 400; word-wrap: break-word">${student.E_NAME}</div>
                                    <div style="left: 257px; top: 605px; position: absolute; color: black; font-size: 30px; font-family: Roboto; font-weight: 400; word-wrap: break-word">${student.E_CONTACT}</div>
                                    <div style="left: 24px; top: 1139px; position: absolute; color: white; font-size: 30px; font-family: Roboto; font-weight: 700; word-wrap: break-word">VALID UNTIL AUGUST 2025</div>
                                </div>
                            `;

                            // Append the student container to printContainer
                            $('#printContainer').append(`<div id="student-${studentId}" class="student-id-container">${frontIDHtml}${backIDHtml}</div>`);

                            // Wait for images to load before capturing
                            waitForImagesToLoad(document.getElementById(`student-${studentId}`)).then(function() {

                                htmlToImage.toPng(document.getElementById(`${studentId}-front`), {
                                        quality: 1
                                    })
                                    .then(function(dataUrl) {
                                        const formData = new FormData();
                                        formData.append('image', dataURLtoBlob(dataUrl), `${studentId}_front.png`);

                                        $.ajax({
                                            url: 'save_image.php',
                                            method: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function(response) {
                                                const result = JSON.parse(response);
                                                if (result.status === 'success') {
                                                    console.log(`Image ${studentId}_front saved successfully`);
                                                } else {
                                                    console.error('Error saving image:', result.message);
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                console.error('Error saving image:', textStatus, errorThrown);
                                            }
                                        });
                                    }).catch(function(error) {
                                        console.error('Error capturing front ID:', error);
                                    });

                                // Capture back ID
                                htmlToImage.toPng(document.getElementById(`${studentId}-back`), {
                                        quality: 1
                                    })
                                    .then(function(dataUrl) {
                                        const formData = new FormData();
                                        formData.append('image', dataURLtoBlob(dataUrl), `${studentId}_back.png`);

                                        $.ajax({
                                            url: 'save_image.php',
                                            method: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function(response) {
                                                const result = JSON.parse(response);
                                                if (result.status === 'success') {
                                                    console.log(`Image ${studentId}_back saved successfully`);
                                                } else {
                                                    console.error('Error saving image:', result.message);
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                console.error('Error saving image:', textStatus, errorThrown);
                                            }
                                        });
                                    }).catch(function(error) {
                                        console.error('Error capturing back ID:', error);
                                    });
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });

            // Helper function to wait for all images to load
            function waitForImagesToLoad(container) {
                var images = container.getElementsByTagName('img');
                var promises = [];

                for (var i = 0; i < images.length; i++) {
                    var img = images[i];

                    // If image is not yet fully loaded
                    if (!img.complete) {
                        promises.push(new Promise(function(resolve, reject) {
                            img.onload = function() {
                                resolve();
                            };

                            img.onerror = function() {
                                // Fallback for missing images
                                this.src = 'input/default.jpg';
                                resolve(); // Resolve promise even if image fails to load
                            };
                        }));
                    }
                }

                return Promise.all(promises);
            }



            // Convert base64 URL to Blob
            function dataURLtoBlob(dataurl) {
                var arr = dataurl.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);
                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new Blob([u8arr], {
                    type: mime
                });
            }
        });
    </script>
</body>

</html>