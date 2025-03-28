<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Bottom Bar</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 flex flex-col items-center justify-between min-h-screen text-gray-800">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class=" bg-yellow-500 p-4 " type="submit">Logout</button>
    </form>


    <!-- Konten Utama -->
    <div class="flex-1 flex items-center justify-center text-center">
        <h1 class="text-3xl font-bold text-gray-700">Welcome to Dashboard</h1>
    </div>

    <div class="fixed bottom-0 left-0 w-full bg-blue-700 text-white shadow-md">
        <div class="flex justify-around py-3">
            <a href="#" class="flex flex-col items-center hover:text-yellow-400 transition">
                <i class="fas fa-home text-xl"></i>
                <span class="text-xs">Home</span>
            </a>
            <a href="#" class="flex flex-col items-center hover:text-yellow-400 transition">
                <i class="fas fa-user-check text-xl"></i>
                <span class="text-xs">Attendance</span>
            </a>
            <a href="#" class="flex flex-col items-center hover:text-yellow-400 transition">
                <i class="fas fa-history text-xl"></i>
                <span class="text-xs">History</span>
            </a>
            <a href="#" class="flex flex-col items-center hover:text-yellow-400 transition">
                <i class="fas fa-credit-card text-xl"></i>
                <span class="text-xs">Payment</span>
            </a>
            <a href="#" class="flex flex-col items-center hover:text-yellow-400 transition">
                <i class="fas fa-user text-xl"></i>
                <span class="text-xs">Profile</span>
            </a>
        </div>
    </div>


</body>

</html>