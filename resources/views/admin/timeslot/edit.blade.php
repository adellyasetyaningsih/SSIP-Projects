@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6">Edit Time Slot</h1>

  <form action="{{ route('admin.timeslots.update', $timeslot->time_slot_id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block font-medium">Time Slot ID</label>
      <input type="text" name="time_slot_id" value="{{ $timeslot->time_slot_id }}" readonly
            class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">
    </div>

    <div>
      <label class="block font-medium">Category</label>
      <input type="text" value="{{ $timeslot->category_id }}" readonly
            class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">
    </div>

    <div>
      <label class="block font-medium">Subject</label>
      <input type="text" value="{{ $timeslot->subject->subject_id ?? '-' }}" readonly
            class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">
    </div>

    <div>
      <label class="block font-medium">Teacher</label>
      <input type="text" value="{{ $timeslot->teacher->teacher_id ?? '-' }}" readonly
            class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100 cursor-not-allowed">
    </div>

    <div>
      <label class="block font-medium">Date</label>
      <input type="date" name="date" class="w-full mt-1 p-2 border border-gray-300 rounded" required value="{{ $timeslot->date }}">
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block font-medium">Start Time</label>
        <input type="time" name="start_time" class="w-full mt-1 p-2 border border-gray-300 rounded" required value="{{ $timeslot->start_time }}">
      </div>
      <div>
        <label class="block font-medium">End Time</label>
        <input type="time" name="end_time" class="w-full mt-1 p-2 border border-gray-300 rounded" required value="{{ $timeslot->end_time }}">
      </div>
    </div>

    <div>
      <label class="block font-medium">Classroom</label>
      <input type="text" name="classroom" class="w-full mt-1 p-2 border border-gray-300 rounded" value="{{ $timeslot->classroom }}">
    </div>

    <div class="pt-4">
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </div>
  </form>
</div>
@endsection
