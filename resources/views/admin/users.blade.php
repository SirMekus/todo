<x-layout.master>
    <div class='card'>
        <div class='card-body'>
            <x-page-header header="Users"></x-page-header>
                <form class="form-inline row" method="get" action="{{url()->current()}}" role="search">
                    <div class="col-4 my-1">
                        <label>Search</label>
                        <input type="text" value="{{request()->search}}" name="search" class="form-control input-lg" placeholder="search for..." />
                    </div>

                    <div class="col-4 my-1 mt-2">
                        <button type="submit" class="btn home-color text-white btn-sm mt-4">Search</button>
                    </div>
                </form>

            <div class='table-responsive'>
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $i = 0;
                    $offset = ($result->currentPage() - 1) * $result->perPage();
                    @endphp

                    @foreach($result as $user)

                    @php
                    $i +=1;
                    $sn = $offset + $i;
                    @endphp

                    <tr>
                        <td>{{$sn}}</td>
                        
                        <td>{{$user->name['firstname']}} {{$user->name['lastname']}}</td>

                        <td>{{$user->email}}</td>

                        <td>{{$user->created_at->toDayDateTimeString()}}</td>

                        @can('isOga', request()->user('admin'))
                        <td>
                            <a class="text-decoration-none btn btn-sm btn-info open-as-modal" href="{{route('activity.form', ['user_id'=>$user->id])}}">Create Activity</a>
                        </td>
                        @endcan

                        <td>
                            <a class="text-decoration-none btn btn-sm btn-primary" href="{{route('activities', ['user_id'=>$user->id])}}">Activities</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <hr />

            {{ $result->links() }}


            <h3>Total: {{$result->total()}}</h3>

        </div>
    </div>
</x-layout.master>