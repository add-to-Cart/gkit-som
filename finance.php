<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 p-4 lg:p-6">
        <!-- Transactions History Panel -->
        <div class="bg-white xl:col-span-2 shadow-md rounded-lg p-6 lg:p-8 max-h-screen flex flex-col">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-center mb-6">
                <!-- Transactions History Title -->
                <div class="lg:col-span-1 text-center lg:text-left">
                    <h2 class="text-2xl font-semibold text-gray-700">Transactions History</h2>
                </div>


                <!-- Void Button and Date Filter -->
                <div class="lg:col-span-2 flex flex-col lg:flex-row items-center text-center lg:justify-end gap-4">
                    <!-- Transaction ID Display -->
                    <div class="w-full lg:w-auto flex items-center justify-center lg:justify-end">
                        <h5 class="font-medium text-green-600">
                            TID: <span id="transaction-id-container" class="text-gray-800"></span>
                        </h5>
                    </div>

                    <!-- Void Button -->
                    <div class="w-full lg:w-auto flex items-center justify-center lg:justify-end">
                        <button id="openVoidModalBtn"
                            class="w-full lg:w-auto px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition duration-300">
                            Void
                        </button>
                    </div>

                    <!-- Date Filter Input -->
                    <div class="w-full lg:w-auto flex items-center justify-center lg:justify-end">
                        <input type="date" id="transaction_date"
                            class="w-full lg:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    </div>
                </div>



            </div>


            <div class="relative mb-5">
                <input type="search" id="search_transaction"
                    class="block w-full p-3 pl-10 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Search Student" required>
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10.5 16.5a6 6 0 110-12 6 6 0 010 12z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 mb-4">
                <h5 class="font-medium text-green-600">Total Payment: <span id="totalPayment"></span></h5>
                <h5 class="font-medium text-red-600">Total Balance: <span id="totalBalance"></span></h5>
            </div>

            <div class="overflow-auto border border-gray-200 rounded-lg max-h-[500px]">
                <table id="transactionTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 sticky top-0">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">TID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">SNumber</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Degree</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Amount Paid</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Balance</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Employee</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Dynamic Data Rows -->
                        <tr class="hover:bg-gray-50">
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Form Panel -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form id="paymentForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="enrollment_fee" class="block text-gray-700 mb-2 text-lg font-medium">Enrollment Fee</label>
                        <input type="text" id="enrollment_fee" name="enrollment_fee"
                            class="block w-full p-3 border border-gray-300 rounded-lg text-red-500" readonly required>
                    </div>
                    <div>
                        <label for="degree" class="block text-gray-700 mb-2 text-lg font-medium">Degree</label>
                        <select id="degree" name="degree"
                            class="block w-full p-3 border border-gray-300 rounded-lg" required>
                            <option value="" disabled selected>Select Degree</option>
                            <option value="ASSOCIATE">ASSOCIATE</option>
                            <option value="BACHELOR">BACHELOR</option>
                            <option value="MASTERAL">MASTERAL</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="student_number" class="block text-gray-700 mb-2 text-lg font-medium">Student Number</label>
                        <input type="text" id="student_number" name="student_number"
                            class="block w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label for="status" class="block text-gray-700 mb-2 text-lg font-medium">Status</label>
                        <input type="text" id="status" name="status"
                            class="block w-full p-3 border border-gray-300 rounded-lg" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div>
                        <label for="balance" class="block text-gray-700 mb-2 text-lg font-medium">Balance</label>
                        <input type="text" id="balance" name="balance"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-red-500" required>
                    </div>
                    <div>
                        <label for="id_balance" class="block text-gray-700 mb-2 text-lg font-medium">ID Balance</label>
                        <input type="text" id="id_balance" name="id_balance"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-red-500" required>
                    </div>
                    <div>
                        <label for="total_payment" class="block text-gray-700 mb-2 text-lg font-medium">Total Payment</label>
                        <input type="text" id="total_payment" name="total_payment"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-green-500" required>
                    </div>
                </div>

                <div class="col-span-3 mt-6">
                    <label for="payment_description" class="block text-gray-700 mb-2 text-lg font-medium">Payment Description</label>
                    <textarea id="payment_description" name="payment_description"
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-lg text-gray-700 h-32" required></textarea>
                </div>

                <div class="mt-6 flex justify-end space-x-6">
                    <button type="button" id="btnConfirm"
                        class="w-full md:w-auto bg-yellow-400 text-red-900 font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-500 transition duration-300">
                        Confirm
                    </button>
                    <button type="reset"
                        class="w-full md:w-auto bg-red-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                        Clear
                    </button>
                </div>
            </form>
        </div>


    </div>
    <!-- Void Confirmation Modal -->
    <div id="voidModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-md shadow-lg p-6 w-80">
            <!-- Modal Title -->
            <h2 class="text-center text-lg font-semibold text-gray-800 mb-4">Confirm Void</h2>

            <!-- Modal Content -->
            <div id="transactionIDSection" class="mb-6">
                <h5 class="text-sm font-semibold text-gray-700 mb-2">Void Transaction ID</h5>
                <div class="flex items-center space-x-2">
                    <!-- Icon to indicate it's the ID display -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17v5h2v-5m-6 0v5h2v-5m-6 0v5h2v-5M8 12h8M8 16h8M8 8h8M8 4h8M3 4h1a4 4 0 0 1 4 4v6h3a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a4 4 0 0 1 4-4H3m10 2V3m2 4V7h-1c-1.1 0-1.99.9-1.99 2L9 10h3"></path>
                    </svg>

                    <!-- Transaction ID Display -->
                    <span id="transaction-id-data" class="flex-1 py-2 px-3 text-gray-800 bg-gray-100 rounded-lg border border-gray-300 shadow-sm text-sm font-medium tracking-wide">
                        <!-- Placeholder text in case the transaction ID is not set -->
                        <span class="text-gray-400">Transaction ID will appear here</span>
                    </span>
                </div>
            </div>


            <p id="transactionWarning" class="text-center text-sm text-gray-600 mb-6 hidden">
                Are you sure you want to void this transaction? This action cannot be undone.
            </p>

            <!-- Buttons -->
            <div class="flex justify-between gap-4">
                <!-- Cancel Button -->
                <button id="cancelVoidBtn"
                    class="w-full bg-gray-300 text-gray-700 font-semibold py-2 rounded-lg hover:bg-gray-400 transition duration-200">
                    Cancel
                </button>

                <!-- Confirm Void Button -->
                <button id="confirmVoidBtn"
                    class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition duration-200 disabled:opacity-50"
                    disabled>
                    Void
                </button>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            let search_data = $('#search_transaction');
            let filter_date = $('#transaction_date');
            // Attach a click event to rows with the class "transaction-row"
            $("#transactionTable").on("click", ".transaction-row", function() {
                // Retrieve the TRANSACTION_ID from the data attribute
                const transactionId = $(this).data("transaction-id");
                $('#transaction-id-container').text(transactionId);
                console.log(transactionId);
            });
            $('#openVoidModalBtn').on('click', function() {
                // Get the text content of the transaction ID container
                const transactionId = $('#transaction-id-container').text().trim();

                // Validate the transaction ID
                if (!transactionId || transactionId <= 0) {
                    alert('Invalid Transaction ID. Please select a valid transaction.');
                    return; // Stop execution if the validation fails
                }

                // Set the value of the span with the retrieved transaction ID
                $('#transaction-id-data').text(transactionId);

                // Enable the confirm button and show the warning
                $('#confirmVoidBtn').prop('disabled', false);
                $('#transactionWarning').removeClass('hidden'); // Show confirmation warning

                // Display the modal by removing the 'hidden' class
                $('#voidModal').removeClass('hidden');
            });

            // Cancel button closes the modal
            $('#cancelVoidBtn').on('click', function() {
                $('#voidModal').addClass('hidden');
            });



            // Confirm void button action
            $('#confirmVoidBtn').on('click', function() {
                var transactionID = $('#transaction-id-data').text().trim();

                if (transactionID.length > 0) {
                    // Process the void action: send AJAX request to update the transaction status and reset auto-increment
                    $.ajax({
                        url: 'void_transaction.php', // PHP file to handle the void operation
                        type: 'POST',
                        data: {
                            transactionID: transactionID
                        },
                        success: function(response) {
                            fetchTransactions();
                            console.log('Void action successful:', response);

                            // After confirmation, close the modal
                            $('#voidModal').addClass('hidden');



                            $('#transactionWarning').addClass('hidden');

                            // Optionally, display a success message or update the UI
                            alert('Transaction voided successfully!');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Failed to void the transaction');
                        }
                    });
                }
            });

            // Change event listener for the degree dropdown to update the fee
            $('#degree').change(function() {
                const degree = $(this).val();
                let fee = 0;
                switch (degree) {
                    case 'ASSOCIATE':
                        fee = 3000;
                        break;
                    case 'BACHELOR':
                        fee = 3200;
                        break;
                    case 'MASTERAL':
                        fee = 5000;
                        break;
                }
                $('#enrollment_fee').val(fee);
            });

            // Fetch transactions based on search term and date filter
            function fetchTransactions(search = '', date = '') {
                let totalPayment = 0; // Ensure the total is reset on each new fetch
                let totalBalance = 0;

                $.ajax({
                    url: 'fetch_transactions.php',
                    type: 'GET', // Using GET method for this request
                    data: {
                        date: date,
                        search: search
                    },
                    dataType: 'json',
                    success: function(response) {
                        const tbody = $('#transactionTable tbody');
                        tbody.empty(); // Clear existing rows

                        // Check if transactions are available in the response
                        if (response.transactions && response.transactions.length > 0) {
                            response.transactions.forEach((transaction) => {
                                tbody.append(`
                        <tr class="hover:bg-gray-50 cursor-pointer transaction-row" data-transaction-id="${transaction.TRANSACTION_ID}">
                            <td class="px-4 py-2">${transaction.TRANSACTION_ID}</td>
                            <td class="px-4 py-2">${transaction.STUDENT_NUMBER}</td>
                            <td class="px-4 py-2">${transaction.NAME}</td>
                            <td class="px-4 py-2">${transaction.STATUS}</td>
                            <td class="px-4 py-2">${transaction.DEGREE}</td>
                            <td class="px-4 py-2">${transaction.AMOUNT_PAID}</td>
                            <td class="px-4 py-2">${transaction.BALANCE}</td>
                            <td class="px-4 py-2">${transaction.PAYMENT_DESCRIPTION}</td>
                            <td class="px-4 py-2">${transaction.EMPLOYEE}</td>
                            <td class="px-4 py-2">${transaction.DATE_CREATED}</td>
                        </tr>
                    `);

                                // Accumulate totals
                                totalPayment += parseFloat(transaction.AMOUNT_PAID) || 0; // Handle cases with no payment value
                                totalBalance += parseFloat(transaction.BALANCE) || 0; // Handle cases with no balance value
                            });

                            // Update the totals after the loop
                            $('#totalPayment').text('₱' + totalPayment.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }));
                            $('#totalBalance').text('₱' + totalBalance.toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }));
                        } else {
                            // Show a message if no transactions are found
                            tbody.append('<tr><td colspan="9" class="px-4 py-2 text-center">No transactions found</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }

            // Initial fetch when the page loads
            fetchTransactions();

            // Handle input changes and trigger fetch
            $('#transaction_date, #search_transaction').on('input change', function() {
                const searchTerm = $('#search_transaction').val();
                const date = $('#transaction_date').val();
                fetchTransactions(searchTerm, date); // Fetch transactions based on both search and date
            });

            // Real-Time Validation for Numeric Fields
            $('input[type="text"]').on('input', function() {
                const fieldName = $(this).attr('id');
                const value = $(this).val();

                if (['balance', 'id_balance', 'total_payment'].includes(fieldName)) {
                    if (!/^\d+(\.\d{1,2})?$/.test(value) && value !== '') {
                        $(this).next('.error-message').remove();
                        $(this).after('<span class="error-message text-red-500 text-sm">Please enter a valid number.</span>');
                    } else {
                        $(this).next('.error-message').remove();
                    }
                }
            });

            // Form Submission Validation
            $('#btnConfirm').on('click', function(e) {
                e.preventDefault();
                let isValid = true;

                // Check required fields
                $('#paymentForm input, #paymentForm select, #paymentForm textarea').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).addClass('border-red-500');
                        isValid = false;
                    } else {
                        $(this).removeClass('border-red-500');
                    }
                });

                // Validate numeric fields
                if (!/^\d+(\.\d{1,2})?$/.test($('#balance').val()) ||
                    !/^\d+(\.\d{1,2})?$/.test($('#id_balance').val()) ||
                    !/^\d+(\.\d{1,2})?$/.test($('#total_payment').val())) {
                    alert('Please ensure numeric fields contain valid numbers.');
                    isValid = false;
                }

                // Validate description length
                if ($('#payment_description').val().length > 250) {
                    alert('Payment description should not exceed 250 characters.');
                    isValid = false;
                }

                // Submit form if valid
                if (isValid) {
                    $.ajax({
                        url: 'submit_payment.php',
                        type: 'POST',
                        data: $('#paymentForm').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                $('#paymentForm')[0].reset();
                                fetchTransactions(); // Fetch transactions again after submitting
                            } else {
                                alert('Submission failed: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('An error occurred during submission.');
                        },
                    });
                } else {
                    alert('Please fix the errors before submitting the form.');
                }
            });
        });
    </script>

</body>

</html>