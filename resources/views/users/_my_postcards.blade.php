<div class="panel panel-default">
    <div class="panel-heading text-center">
        My Postcard
    </div>
    <table class="table table-striped table-sort">
        <thead>
        <tr>
            <th>Joined On</th>
            <th>Name</th>
            <th>Country</th>
            {{--<th>Address</th>--}}
            <th>Postcode</th>
            <th>Email</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($postcards as $postcard)
            <tr>
                <td>{{ $postcard->created_at->diffForHumans() }}</td>
                <td>{{ $postcard->real_name }}</td>
                <td>{{ $postcard->country }}</td>
                {{--<td>{{ $postcard->address }}</td>--}}
                <td>{{ $postcard->postcode }}</td>
                <td>{{ $postcard->email }}</td>
                <td>
                    @if ($postcard->status == 'created')
                        <span class="label label-warning">{{$postcard->status}}</span>
                    @elseif ($postcard->status == 'paid')
                        <span class="label label-primary">{{$postcard->status}}</span>
                    @elseif ($postcard->status == 'sent')
                        <span class="label label-default">{{$postcard->status}}</span>
                    @elseif ($postcard->status == 'missing')
                        <span class="label label-danger">{{$postcard->status}}</span>
                    @endif
                </td>
                <td style="text-align:center;">
                    <a href="{{ route('postcard.show', $postcard->id) }}" class="btn btn-xs btn-link">
                        <i class="fa fa-gear"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="text-center">
    {!! $postcards->render() !!}
</div>