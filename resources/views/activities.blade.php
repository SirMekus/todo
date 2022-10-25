<x-layout.master>
    <div class="card">
        <div class="rounded-0 card-body">
            <x-page-header header="Activities"></x-page-header>

            <form class="form-inline row" method="get" action="{{url()->current()}}" role="search">
                <div class="col-4 my-1">
                    <label>Date</label>
                    <input type="date" value="{{$date}}" name="date" class="form-control input-lg" />
                </div>

                <div class="col-4 my-1 mt-2">
                    <button type="submit" class="btn home-color text-white btn-sm mt-4">Search</button>
                </div>
            </form>

            <div class="d-flex justify-content-center">
                <div class="text-decoration-none bg-dark text-light btn">
                    <span class="text-center fs-1 fw-bolder">{{carbon($date)->format('jS')}}</span><br />
                    <span class="fw-bold">{{carbon($date)->format('F, Y')}}</span>
                </div>
            </div>
            <hr/>

            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr class="sticky-top">
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Title</th>
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

                            <td><img class="img-thumbnail" width="60"
                                data-src="{{ asset('storage/activities/'.$activity->image)}}" /></td>

                            <td>{{$activity->title}}</td>

                            <td>{{$activity->description}}</td>

                            <td>{{$activity->created_at->toDayDateTimeString()}}</td>

                            <td>
                                <a class="text-decoration-none btn btn-sm bg-warning open-as-modal" href="{{route('activity.form', ['id'=>$activity->id, 'user_id'=>request()->user_id])}}"><i
                                class="fa fa-edit text-white fa-fw"></i></a>
                            </td>

                            <td>
                                <a class="text-decoration-none btn btn-sm bg-danger" href="#"><i
                                    class="fa fa-trash text-white fa-fw"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                    <a class="text-decoration-none text-white btn btn-lg bg-dark open-as-modal" href="{{route('activity.form')}}">
                        <span>Create Activity</span>
                    </a>
            </div>

        </div>
    </div>
</x-layout.master>