@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  {{-- Flash message --}}
  @if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded">
      {{ session('success') }}
    </div>
  @elseif(session('error'))
    <div class="bg-red-500 text-white p-4 mb-4 rounded">
      {{ session('error') }}
    </div>
  @endif

  {{-- Header Student --}}
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Student Data</h1>
    <div class="flex items-center space-x-2">
      <input type="text" id="searchInput" placeholder="Search..." class="border px-3 py-2 rounded text-sm" />
      <a href="{{ route('register.student') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        Add Student
      </a>
    </div>
  </div>

  {{-- Student Table --}}
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white text-sm border rounded shadow">
      <thead>
        <tr class="bg-yellow-400 text-black">
          {{-- Judul kolom tabel --}}
          <th class="py-3 px-4 text-left border-b">Student ID</th>
          <th class="py-3 px-4 text-left border-b">First Name</th>
          <th class="py-3 px-4 text-left border-b">Last Name</th>
          <th class="py-3 px-4 text-left border-b">Birth Date</th>
          <th class="py-3 px-4 text-left border-b">Phone Number</th>
          <th class="py-3 px-4 text-left border-b">Email</th>
          <th class="py-3 px-4 text-left border-b">Category</th>
          <th class="py-3 px-4 text-left border-b">Action</th>
        </tr>
      </thead>
      <tbody id="studentTableBody">
        {{-- Loop semua student dan tampilkan dalam tabel --}}
        @foreach($students as $student)
        <tr class="hover:bg-gray-100">
          <td class="py-3 px-4 border-b">{{ $student->student_id }}</td>
          <td class="py-3 px-4 border-b">{{ $student->f_name }}</td>
          <td class="py-3 px-4 border-b">{{ $student->l_name }}</td>
          <td class="py-3 px-4 border-b">{{ $student->d_birth }}</td>
          <td class="py-3 px-4 border-b">{{ $student->phone_num }}</td>
          <td class="py-3 px-4 border-b">{{ $student->email }}</td>
          <td class="py-3 px-4 border-b">{{ $student->category_id }}</td>
          <td class="py-3 px-4 border-b flex space-x-2">

          {{-- Tombol edit student, arahkan ke route admin.students.edit --}}
          <a href="{{ route('admin.students.edit', $student->student_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>

          <form action="{{ route('admin.students.destroy', $student->student_id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
              @csrf
              @method('DELETE') {{-- Spoof method menjadi DELETE --}}
              <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded ml-2">Delete</button>
          </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Header Payment --}}
  <h1 class="text-2xl font-bold mt-12 mb-6">Payment Data</h1>

  {{-- Payment Table --}}
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white text-sm border rounded shadow">
      <thead>
        <tr class="bg-yellow-400 text-black">
          <th class="py-3 px-4 text-left border-b">Payment ID</th>
          <th class="py-3 px-4 text-left border-b">Name</th>
          <th class="py-3 px-4 text-left border-b">Amount</th>
          <th class="py-3 px-4 text-left border-b">Payment Status</th>
          <th class="py-3 px-4 text-left border-b">Date</th>
          <th class="py-3 px-4 text-left border-b">Action</th>
        </tr>
      </thead>
      <tbody id="studentTableBody">
        {{-- Loop semua payment dan tampilkan dalam tabel --}}
        @foreach($payments as $payment)
        <tr class="hover:bg-gray-100">
          <td class="py-3 px-4 border-b">{{ $payment->pay_ID }}</td>
          {{-- Menampilkan nama student dari relasi payment -> student --}}
          <td class="py-3 px-4 border-b">{{ $payment->student->f_name }} {{ $payment->student->l_name }}</td>
          <td class="py-3 px-4 border-b"> Rp{{ number_format(optional($payment->student->category)->price, 0, ',', '.') }}</td>
          <td class="py-3 px-4 border-b">
            @php
              $statusColor = match($payment->pay_status) {
                'confirmed' => 'bg-green-200 text-green-800',
                'rejected' => 'bg-red-200 text-red-800',
                'pending' => 'bg-blue-200 text-blue-800',
                default => 'bg-gray-200 text-gray-800'
              };
            @endphp
            <span class="px-2 py-1 rounded {{ $statusColor }}">
              {{ ucfirst($payment->pay_status) }}
            </span>
          </td>

          {{-- Tanggal pembayaran dibuat --}}
          <td class="py-3 px-4 border-b">{{ $payment->created_at }}</td>
          <td class="py-3 px-4 border-b">
            {{-- Tombol untuk edit status pembayaran --}}
            <a href="{{ route('admin.payment.edit', $payment->pay_ID) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
              Edit Status
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Script JavaScript untuk fitur pencarian student secara live --}}
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase(); // Ambil nilai input & ubah ke huruf kecil
    const rows = document.querySelectorAll('#studentTableBody tr'); // Ambil semua baris tabel student

    rows.forEach(row => {
      const text = row.textContent.toLowerCase(); // Ambil isi baris dan ubah ke huruf kecil
      row.style.display = text.includes(query) ? '' : 'none'; // Sembunyikan baris jika tidak cocok
    });
  });
</script>
@endsection
