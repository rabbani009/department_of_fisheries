@php
$index = 1;
@endphp
@foreach ($data as $item)
    <tr>
        <td>{{ $index }}</td>
        <td><a href="{{ route('viewFishers', $item->id) }}">
                {{ $item->fisherName }}</a></td>

        <td>{{ $item->phone }}</td>
        <td>
            <div class="badge badge-success">{{ $item->status }}</div>
        </td>
        <td>
            <a href="{{ route('viewFishers', $item->id) }}" class="btn btn-info-soft btn-sm mr-1" title="View"><i
                    class="far fa-eye"></i></a>
            <a href="{{ route('editFishers', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" title="Edit"><i
                    class="far fa-edit"></i></a>
            <a href="{{ route('deleteFishersList', $item->id) }}" class="btn btn-danger-soft btn-sm deleteItem"
                title="Delete"><i class="far fa-trash-alt"></i></a>
        </td>
    </tr>
    @php
        $index++;
    @endphp
@endforeach
