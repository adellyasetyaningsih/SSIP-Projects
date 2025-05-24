@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6">Edit Payment Status</h1>

  <form action="{{ route('admin.payment.update', $payment->pay_ID) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label for="pay_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
      <select name="pay_status" id="pay_status" class="w-full p-2 border rounded mt-2">
        <option value="pending" {{ $payment->pay_status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="confirmed" {{ $payment->pay_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
        <option value="rejected" {{ $payment->pay_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
      @error('pay_status')
        <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Payment Status</button>
  </form>
</div>
@endsection
