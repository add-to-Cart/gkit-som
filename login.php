<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="shadow-2xl bg-red-900 p-8 sm:max-w-md w-full rounded-lg border border-gray-300">
        <div class="text-center mb-6">
            <img class="h-24 mx-auto bg-white p-1 rounded-full shadow-md" src="input/gkit-logo.png" alt="GKITSOM Logo">
            <h2 class="text-3xl font-extrabold text-white mt-4">Welcome to GKITSOM</h2>
            <p class="mt-2 text-sm text-gray-200">Sign in to continue</p>
        </div>

        <form id="loginForm" class="space-y-6">
            <div>
                <label for="account-number" class="block text-sm font-medium text-gray-200">Account Number</label>
                <div class="mt-2">
                    <input id="account-number" name="account_number" type="text" autocomplete="off" required
                        class="block w-full rounded-md border-gray-300 focus:ring-yellow-400 focus:border-yellow-400 sm:text-sm p-3"
                        placeholder="Enter your account number">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <div class="mt-2 relative">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full rounded-md border-gray-300 focus:ring-yellow-400 focus:border-yellow-400 sm:text-sm p-3"
                        placeholder="Enter your password">
                    <a href="#" class="absolute right-3 top-3 text-sm text-yellow-400 hover:underline">Forgot?</a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-yellow-400 text-red-900 font-semibold py-3 rounded-md shadow-lg hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition duration-300">
                    Sign in
                </button>
            </div>

            <div id="responseContainer" class="mt-4 text-sm text-center text-gray-200"></div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $('#responseContainer').html('<p>Loading...</p>');

                $.ajax({
                    url: 'verify_login.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseContainer').html(response);
                    },
                    error: function() {
                        $('#responseContainer').html('<p class="text-red-500">Error processing your request. Try again.</p>');
                    }
                });
            });
        });
    </script>
</body>

</html>