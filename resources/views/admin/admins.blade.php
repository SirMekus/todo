<x-layout.master>
    <div class='card'>
        <div class='card-body'>
            <x-page-header header="Admins"></x-page-header>

                <form class="form-inline row" method="get" action="{{url()->current()}}" role="search">
                    <div class="col-4 my-1">
                        <label>Search</label>
                        <input type="text" value="{{request()->search}}" name="search" class="form-control input-lg" placeholder="search for..." />
                    </div>

                    <div class="col-4 my-1 mt-2">
                        <button type="submit" class="btn home-color text-white btn-sm mt-4">Search</button>
                    </div>
                </form>

                @can('isOga', request()->user('admin'))
                <div>
                    <a class="text-decoration-none text-dark float-end"
                        href="{{route('admin.create')}}">
                        <i class="fas fa-circle-plus fa-2x"></i>
                    </a>
                </div>
                @endcan

            <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr class="sticky-top">
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>

                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                    $i = 0;
                    $offset = ($result->currentPage() - 1) * $result->perPage();
                    @endphp

                    @foreach($result as $items)

                    @php
                    $i +=1;
                    $sn = $offset + $i;
                    @endphp

                    <tr>
                        <td>{{$sn}}</td>
                        
                        <td><a class="text-home" href='{{route('admin.create',['id'=>$items->id])}}'>{{$items->name['firstname']}} {{$items->name['lastname']}}</a>
                        </td>

                        <td>{{$items->email}}
                        </td>

                        <td><span class="badge badge-pill bg-dark">{{$items->role}}</span></td>

                        <td><span class="badge badge-pill bg-{{$items->active >=1 ? 'success' : 'danger'}}">{{$items->account_status}}</span></td>

                        <td>{{$items->created_at->toDayDateTimeString()}}</td>

                        @can('isOga', request()->user('admin'))
                        <td>
                            <div class="btn-group dropdown">
                                <button type="button" class="btn home-color text-white dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Manage
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item {{($items->active >= 1) ? 'disabled' : null}}" href="{{route('admin.reactivate', ['id'=>$items->id])}}"><i class="fa fa-play-circle text-success fa-fw"></i>Activate</a>
                                  
                                  <a class="dropdown-item pre-run {{($items->active >= 1) ? null : 'disabled'}}" data-caption="Are you sure you want to deactivate this account?" href="{{route('admin.deactivate', ['id'=>$items->id])}}"><i class="fa fa-circle-stop text-danger fa-fw"></i>Deactivate</a>
                                  
                                  <a class="dropdown-item bg-danger pre-run text-white text-decoration-none" href="{{route('admin.delete', ['id'=>$items->id])}}" data-caption="Are you sure you want to delete this account? Note that this operation can not be undone."><i class="fa fa-address-book fa-fw"></i>Delete Account</a>

                                </div>
                            </div>
                        </td>
                        @endcan

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