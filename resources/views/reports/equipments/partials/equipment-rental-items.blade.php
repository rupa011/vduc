<table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
        <tr>
            <th>Rental ID</th>
            <th>Equipment Name</th>
            <th>Total Quantity</th>
            <th>Rented Quantity</th>
            <th>Available Quantity</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $rental)
            @foreach ($rental->equipment as $equipment)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $equipment->equipment_name }}</td>
                    <td>{{ $equipment->quantity }}</td>
                    <td>{{ $equipment->pivot->quantity }}</td>
                    <td>{{ $equipment->quantity - $equipment->pivot->quantity }}</td>
                    <td>{{ $rental->status }}</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="6" class="text-center">No rental data available.</td>
            </tr>
        @endforelse
    </tbody>
</table>
