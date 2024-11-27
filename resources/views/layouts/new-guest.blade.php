 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAP Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha384-ZZ1pncU3bQe8y31yfZdMFdSpttDoPmOZg2wguVK9almUodir1PghgT0eY7Mrty8H"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
   <x-nav/>
    <main class="bg-gray-100 flex items-center justify-center min-h-screen">

        <!-- Verification Form -->
        <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-md flex flex-col ">
            <!-- Title -->
            @yield('body')
        </div>

    </main>

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.js"></script>
</body>
</html>
