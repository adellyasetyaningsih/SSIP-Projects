@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">

  {{-- === TIME SLOT SECTION === --}}
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Time Slot Data</h1>
      <div class="flex items-center space-x-2">
        <input type="text" id="searchInput" placeholder="Search Time Slot..." class="border px-3 py-2 rounded text-sm" />
        <a href="{{ route('admin.timeslots.create') }}#timeslot-form" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
          Add Time Slot
        </a>
      </div>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full text-sm border">
        <thead class="bg-yellow-400 text-black">
          <tr>
            <th class="py-3 px-4 text-left border-b">ID</th>
            <th class="py-3 px-4 text-left border-b">Date</th>
            <th class="py-3 px-4 text-left border-b">Start Time</th>
            <th class="py-3 px-4 text-left border-b">End Time</th>
            <th class="py-3 px-4 text-left border-b">Subject</th>
            <th class="py-3 px-4 text-left border-b">Teacher</th>
            <th class="py-3 px-4 text-left border-b">Classroom</th>
            <th class="py-3 px-4 text-left border-b">Actions</th>
          </tr>
        </thead>
        <tbody id="TimeslotTableBody">
          @foreach($time_slots as $timeslot)
            <tr class="hover:bg-gray-100">
              <td class="py-3 px-4 border-b">{{ $timeslot->time_slot_id }}</td>
              <td class="py-3 px-4 border-b">{{ $timeslot->date }}</td>
              <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($timeslot->start_time)->format('H:i') }}</td>
              <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($timeslot->end_time)->format('H:i') }}</td>
              <td class="py-3 px-4 border-b">{{ $timeslot->subject->subject_id ?? '-' }}</td>
              <td class="py-3 px-4 border-b">{{ $timeslot->teacher->teacher_id ?? '-' }}</td>
              <td class="py-3 px-4 border-b">{{ $timeslot->classroom ?? '-' }}</td>
              <td class="py-3 px-4 border-b flex space-x-2">
                <a href="{{ route('admin.timeslots.edit', $timeslot->time_slot_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.timeslots.destroy', $timeslot->time_slot_id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded ml-2">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#TimeslotTableBody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
</script>
@endsection

