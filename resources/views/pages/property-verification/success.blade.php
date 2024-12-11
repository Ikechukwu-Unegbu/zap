@extends('layouts.new-guest')

@section('body')
  <div class="flex justify-center items-center mb-4">
    @if(!isset($response['data']) || empty($response['data']))
    <svg width="177" height="177" viewBox="0 0 177 177" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M75.8882 28.4674L13.422 132.75C12.134 134.98 11.4526 137.509 11.4454 140.085C11.4382 142.66 12.1054 145.193 13.3808 147.43C14.6562 149.668 16.4953 151.532 18.715 152.838C20.9348 154.144 23.4578 154.847 26.0332 154.875H150.966C153.541 154.847 156.064 154.144 158.284 152.838C160.504 151.532 162.343 149.668 163.618 147.43C164.893 145.193 165.561 142.66 165.554 140.085C165.546 137.509 164.865 134.98 163.577 132.75L101.111 28.4674C99.796 26.3 97.9448 24.5079 95.7358 23.2642C93.5268 22.0206 91.0345 21.3672 88.4995 21.3672C85.9644 21.3672 83.4721 22.0206 81.2631 23.2642C79.0541 24.5079 77.2029 26.3 75.8882 28.4674Z" stroke="#D20505" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M88.5 66.375V95.875" stroke="#D20505" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M88.5 125.375H88.5729" stroke="#F00505" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    @else
    <svg width="121" height="118" viewBox="0 0 121 118" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M31.5833 53L55.25 2C59.9576 2 64.4724 3.79107 67.8011 6.97919C71.1299 10.1673 73 14.4913 73 19V41.6667H106.488C108.204 41.6481 109.903 41.9869 111.468 42.6596C113.033 43.3323 114.426 44.3228 115.552 45.5626C116.677 46.8023 117.508 48.2617 117.986 49.8394C118.465 51.4172 118.579 53.0757 118.322 54.7L110.157 105.7C109.729 108.402 108.295 110.866 106.121 112.636C103.946 114.406 101.177 115.364 98.3233 115.333H31.5833M31.5833 53V115.333M31.5833 53H13.8333C10.6949 53 7.68508 54.194 5.4659 56.3195C3.24672 58.4449 2 61.3275 2 64.3333V104C2 107.006 3.24672 109.888 5.4659 112.014C7.68508 114.139 10.6949 115.333 13.8333 115.333H31.5833" stroke="#128217" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    @endif
  </div>

  <!-- Title -->
  <h2 class="text-lg font-semibold mb-2">
    @if(!isset($response['data']) || empty($response['data'])) 
        {{ $response['message'] ?? 'An unexpected error occurred.' }}
    @else 
        Property is approved!
    @endif
  </h2>

  <!-- Button -->
  <a href="{{ route('more', $transaction->reference_id ?? '') }}" class="bg-blue-600 text-white text-sm px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
    View More Details
  </a>

  <!-- Note -->
  <p class="text-gray-500 text-xs mt-3">Note: Each verification is ₦50,000</p>
@endsection
