<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Building Approval Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-md rounded-lg p-6 w-96 text-center">
    <!-- Approval Number -->
    <p class="text-sm font-medium mb-4">
      <span class="font-semibold">Building Approval Number:</span> TK304839434
    </p>
    <!-- Status -->
    <div class="text-left mb-4">
      <h2 class="text-base font-semibold">Building Status</h2>
      <div class="flex items-center mt-2">
        <span class="text-sm font-medium mr-2">Status:</span>
        <span class="bg-green-100 text-green-600 text-xs font-semibold px-2 py-1 rounded">
          Approved
        </span>
      </div>
    </div>
    <!-- Details -->
    <div class="text-left text-sm space-y-2 mb-6">
      <p><span class="font-medium">Full Name:</span> Uba Nnamdi</p>
      <p><span class="font-medium">Document Name:</span> Rock View Estate</p>
      <p><span class="font-medium">Organization Name:</span> Hamaza Estate Limited</p>
      <p><span class="font-medium">District:</span> Epe</p>
    </div>
    <!-- Download Button -->
    <button type="button" class="bg-blue-600 text-white text-sm px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
      Download
    </button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</body>
</html>
