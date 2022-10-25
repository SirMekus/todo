<x-layout.master>

    <section>
        <div class='card'>
            <div class='card-body'>
                <x-page-header header="All {{ucfirst(Str::plural($account))}}"></x-page-header>

                <form class="form-inline row" method="get" action="{{url()->current()}}" role="search">
                    <div class="col-lg-4 col-xs-12 my-1">
                        <label>Search</label>
                        <input type="text" value="{{request()->search}}" name="search" class="form-control input-lg"
                            placeholder="search for..." />
                    </div>

                    <div class="col-lg-4 col-xs-12 my-1 mt-2">
                        <button type="submit" class="btn home-color text-white btn-sm mt-4">Search</button>
                    </div>
                </form>

                @if($result->total() > 0)
                @php
                $i = 0;
                $offset = ($result->currentPage() - 1) * $result->perPage();
                @endphp

                <div class="list-group list-group-flush">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn home-color text-white dropdown-toggle btn-sm float-end"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Export As PDF
                        </button>
                        <div class="dropdown-menu">
                            <form method='get' action="{{route('admin.users.download')}}" class="dropdown-item">
                                <div class="col-12 my-1">
                                    <label>From</label>
                                    <input type="date" name="from" class="form-control input-lg" />
                                </div>
                                <div class="col-12 my-1">
                                    <label>To</label>
                                    <input type="date" name="to" class="form-control input-lg" />
                                </div>
                                @if(request()->filled('artisan'))
                                <input type="hidden" name="artisan" value="2" />
                                @endif

                                <div class="col-12 my-1">
                                    <input type="submit" class="btn home-color text-white btn-sm mt-4" value="Export">
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach ($result as $user)
                    @php
                    $i +=1;
                    $sn = $offset + $i;
                    @endphp

                    <div class="list-group-item m-1 {{$user->status < 1 ? " bg-danger" : null}}" aria-current="true">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                {{ $sn}}.
                                <img class="img-thumbnail" width="100" height="100"
                                    data-src="{{optional($user->personalinformation)->profile_picture}}" />
                            </div>
                            <div class="flex-grow-1 ms-1">
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Name:</span> {{optional($user->personalinformation)->fullname}}
                                </p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Account Type:</span> {{ucfirst($account)}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Email:</span> {{$user->email}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span class='fw-bold'>Phone
                                        Number:</span> {{$user->phone}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Address:</span> {{$user->streetaddress}}, {{$user->lga ??
                                    "(Unknown LGA)"}}, {{$user->state ?? "(Unknown State)"}}</p>

                                @if($user->role == 2)
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Occupation:</span>
                                    {{optional($user->professionalinformation)->occupation}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Skill(s):</span>
                                    {{optional($user->professionalinformation)->skills}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span class='fw-bold'>Start
                                        Budget:</span> NGN
                                    {{number_format(optional($user->professionalinformation)->start_budget ?? 0)}}</p>
                                <p class="mb-1 {{$user->status < 1 ? " text-white" : null}}"><span
                                        class='fw-bold'>Wallet:</span> NGN {{number_format($user->wallet ?? 0)}}</p>
                                @endif

                                <hr class="dropdown-divider">

                                <div>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn home-color text-white dropdown-toggle btn-sm"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item {{($user->status >= 1) ? 'disabled' : null}}"
                                                href="{{route('admin.user.reactivate', ['id'=>$user->id])}}"><i
                                                    class="fa fa-play-circle text-success fa-fw"></i>Activate</a>

                                            @if($user->status >= 1)
                                            <a class="dropdown-item open-as-modal"
                                                href="{{route('admin.user.deactivate', ['id'=>$user->id])}}"><i
                                                    class="fa fa-circle-stop text-danger fa-fw"></i>Deactivate</a>
                                            
                                            @else
                                            <a class="dropdown-item"
                                                href="{{route('admin.users.deactivated', ['id'=>$user->id])}}"><i
                                                    class="fa fa-circle-stop text-danger fa-fw"></i>Deactivated</a>
                                            @endif

                                            @if($user->role == 2)
                                            <a class="dropdown-item"
                                                href="{{route('admin.services', ['user_id'=>$user->id])}}"><i
                                                    class="fa fa-address-book fa-fw"></i>Services</a>
                                            <a class="dropdown-item"
                                                href="{{route('admin.artisan.withdrawal_history', ['id'=>$user->id])}}"><i
                                                    class="fa fa-credit-card fa-fw"></i>Withdrawal History</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{ $result->links() }}
                </div>


                @else
                <div class="rounded-0">
                    <div class="d-flex justify-content-center">
                        <a class="text-decoration-none text-dark" href="#">
                            <i class="fas fa-edit fa-6x text-cente ml-3"></i><br />
                            <span class="ms-3">No users yet</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

</x-layout.master>