<table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Equipment Name</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $equipment)
            <tr>
                <td>{{ $equipment->id }}</td>
                <td>{{ $equipment->equipment_name }}</td>
                <td>{{ $equipment->quantity }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No data available.</td>
            </tr>
        @endforelse
    </tbody>
</table>
