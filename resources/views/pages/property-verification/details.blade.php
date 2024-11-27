@extends('layouts.new-guest')
  @section('body')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha384-ZZ1pncU3bQe8y31yfZdMFdSpttDoPmOZg2wguVK9almUodir1PghgT0eY7Mrty8H"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Approval Number -->
    <p class="text-sm font-medium mb-4">
      <span class="font-semibold float-left">Building Approval Number:</span> 
      {{ $transaction->meta[0]['approval_number'] ?? 'N/A' }}
    </p>
    <!-- Status -->
    <div class="text-left mb-4">
      <h2 class="text-base font-semibold">Building Status</h2>
      <div class="flex items-center mt-2">
        <span class="text-sm font-medium mr-2">Status:</span>
        <span class="{{ empty($transaction->meta) ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }} text-xs font-semibold px-2 py-1 rounded">
          {{ empty($transaction->meta) ? 'Not Approved' : 'Approved' }}
        </span>
      </div>
    </div>
    <!-- Details -->
    <div class="text-left text-sm space-y-2 mb-6">
      <p><span class="font-medium">Document Name:</span> {{ $transaction->meta[0]['name'] ?? 'N/A' }}</p>
      <p><span class="font-medium">Organization Name:</span> {{ $transaction->meta[0]['organization_name'] ?? 'N/A' }}</p>
      <p><span class="font-medium">District:</span> {{ $transaction->meta[0]['district'] ?? 'N/A' }}</p>
    </div>
    <!-- Download Button -->
    <button id="download-btn" type="button" class="bg-blue-600 text-white text-sm px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
      Download
    </button>


  <script>
  document.getElementById('download-btn').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;

    const pdfContent = document.getElementById('pdf-content');
    const downloadBtn = document.getElementById('download-btn');

    // Temporarily hide the download button
    downloadBtn.style.display = 'none';

    // Use html2canvas to capture the content as an image
    html2canvas(pdfContent, { scale: 2 }).then(canvas => {
      const imgData = canvas.toDataURL('image/png');
      const pdf = new jsPDF('p', 'mm', 'a4'); // 'p' for portrait, 'mm' for units, 'a4' for page size

      const imgWidth = 190; // Fit within A4 width
      const pageHeight = pdf.internal.pageSize.height;
      const imgHeight = (canvas.height * imgWidth) / canvas.width;

      let position = 10; // Starting top position
      pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);

      // Restore the button's visibility
      downloadBtn.style.display = '';

      // Save the PDF
      pdf.save('BuildingApprovalDetails.pdf');
    }).catch(() => {
      // Restore the button's visibility in case of an error
      downloadBtn.style.display = '';
    });
  });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
@endsection