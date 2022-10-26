<x-layout.master>
    <div class="card">
        <div class="rounded-0 card-body">
            <x-page-header header="Activities"></x-page-header>

            <form class="form-inline row" method="get" action="{{url()->current()}}" role="search">
                <div class="col-4 my-1">
                    <label>Date</label>
                    <input type="date" value="{{$date}}" name="date" class="form-control input-lg" />
                </div>

                @if(request()->filled('user_id'))
                <input type="hidden" value="{{request()->user_id}}" name="user_id" />
                @endif

                <div class="col-4 my-1 mt-2">
                    <button type="submit" class="btn home-color text-white btn-sm mt-4">Search</button>
                </div>
            </form>

            @if(request()->user('admin') and request()->user('admin')->isSuperAdmin())
            <div class="d-flex justify-content-center">
                <a href="#" class="text-decoration-none bg-dark text-light btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="text-center fs-1 fw-bolder">{{carbon($date)->format('jS')}}</span><br />
                    <span class="fw-bold">{{carbon($date)->format('F, Y')}}</span>
                </a>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!!$calendar->show($date)!!}
                    </div>
                    <div class="modal-footer">
                        <a href='{{url()->current()}}' class='btn float-end text-primary'>Today</a>
                    </div>
                  </div>
                </div>
            </div>
            @endif
            <hr/>

            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr class="sticky-top">
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Intended For</th>
                            <th>Description</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                        $sn = 0;
                        @endphp

                        @foreach($activities as $activity)

                        @php
                        $sn +=1;
                        @endphp

                        <tr>
                            <td>{{$sn}}</td>

                            <td><img class="img-thumbnail" width="60" data-src="{{ asset('storage/activities/'.$activity->image)}}" /></td>

                            <td>{{activityToDisplay($activity)->title}}</td>

                            @if(!empty(activityToDisplay($activity)->user))
                            <td>
                                @if(request()->user('admin'))
                                <a class="text-decoration-none" href="{{route('users', ['id'=>activityToDisplay($activity)->user->id])}}">
                                {{activityToDisplay($activity)->user->name['firstname']}} {{activityToDisplay($activity)->user->name['lastname']}}</a>
                                @else
                                {{activityToDisplay($activity)->user->name['firstname']}} {{activityToDisplay($activity)->user->name['lastname']}}
                                @endif
                            </td>
                            @else
                            <td><span class='badge badge-pill bg-dark'>General</span></td>
                            @endif

                            <td>{{activityToDisplay($activity)->description}}</td>

                            <td>{{$activity->created_at->toDayDateTimeString()}}</td>

                            @if(request()->user('admin') and request()->user('admin')->isSuperAdmin())
                            <td>
                                <a class="text-decoration-none btn btn-sm bg-warning open-as-modal" href="{{route('activity.form', ['id'=>$activity->id, 'user_id'=>request()->user_id])}}"><i
                                class="fa fa-edit text-white fa-fw"></i></a>
                            </td>

                            <td>
                                <a class="text-decoration-none btn btn-sm bg-danger pre-run" data-caption="Are you sure you want to delete this activity?" href="{{route('activity.delete', ['id'=>$activity->id])}}"><i
                                    class="fa fa-trash text-white fa-fw"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{$activities->links()}}

            @if(request()->user('admin') and request()->user('admin')->isSuperAdmin())
            @if($activities->count() < 4)
            <div class="d-flex justify-content-center">
                    <a class="text-decoration-none text-white btn btn-lg bg-dark open-as-modal" href="{{route('activity.form', ['date'=>$date, 'user_id'=>request()->user_id])}}">
                        <span>Create Activity</span>
                    </a>
            </div>
            @endif
            @endif

        </div>
    </div>
</x-layout.master>