 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAP Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
   <x-nav/>
    <main class="bg-gray-100 flex items-center justify-center min-h-screen">

        <!-- Verification Form -->
        <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-md">
            <!-- Title -->
            <h1 class="text-2xl font-semibold text-center mb-6">Start Building Verification Here</h1>
            
            <!-- Form -->
            <form action="{{route('verify')}}" method="POST" class="space-y-4">
                <!-- Email -->
                 @csrf 
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="ndchuks@gmail.com" value="ndchuks@gmail.com" 
                        class="block w-full bg-gray-100 border border-gray-300 rounded-md p-2.5 text-gray-800" readonly>
                </div>
                
                <!-- Approval Number -->
                <div>
                    <label for="approval-number" class="block text-sm font-medium text-gray-700 mb-1">Approval Number</label>
                    <input type="text" id="approval-number" name="approval_number" placeholder="TK304893434" value="TK304893434"
                        class="block w-full bg-gray-100 border border-gray-300 rounded-md p-2.5 text-gray-800" readonly>
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full bg-blue-500 text-white font-medium py-2.5 rounded-md text-center hover:bg-blue-600 transition">
                        Verify
                    </button>
                </div>
            </form>

            <!-- Footer Note -->
            <p class="text-sm text-gray-500 text-center mt-4">Note: Each Verification is ₦60,000</p>
        </div>

    </main>

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>
</body>
</html>
