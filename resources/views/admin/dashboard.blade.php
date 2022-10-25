<x-layout.master>
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="card card-statistics">
                <a class="text-decoration-none text-dark fw-bold" href="{{route('admin.services')}}">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <i class="fa-5x fas fa-newspaper"></i>
                            </div>
                            <div class="float-end">
                                <p class="card-text text-end">Services</p>
                                <div class="fluid-container">
                                    <h6 class="card-title fw-bold text-end mb-0"> {{$total_services}} </h6>
                                </div>
                            </div>
                        </div>
                        <p class="text-home  mt-3">
                            <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Services
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-12">
            <div class="card card-statistics">
                <a class="text-decoration-none text-dark fw-bold" href="{{route('admin.service_requested')}}">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <i class="fa-5x fas fa-handshake"></i>
                            </div>
                            <div class="float-end">
                                <p class="card-text text-end">Requests</p>
                                <div class="fluid-container">
                                    <h6 class="card-title fw-bold text-end mb-0">{{$total_requests}}</h6>
                                </div>
                            </div>
                        </div>
                        <p class="text-home mt-3">
                            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Requested Services
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-12">
            <div class="card card-statistics">
                <a class="text-decoration-none text-dark fw-bold" href="{{route('admin.users')}}">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <i class="fa-5x fas fa-user-tag"></i>
                            </div>
                            <div class="float-end">
                                <p class="card-text text-end">Customers</p>
                                <div class="fluid-container">
                                    <h6 class="card-title fw-bold text-end mb-0">{{$total_users}}</h6>
                                </div>
                            </div>
                        </div>
                        <p class="text-home mt-3">
                            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Customers
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-12">
            <div class="card card-statistics">
                <a class="text-decoration-none text-dark fw-bold" href="{{route('admin.orders')}}">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <i class="fa-5x fas fa-user-tag"></i>
                            </div>
                            <div class="float-end">
                                <p class="card-text text-end">Orders</p>
                                <div class="fluid-container">
                                    <h6 class="card-title fw-bold text-end mb-0">{{$total_orders}}</h6>
                                </div>
                            </div>
                        </div>
                        <p class="text-home mt-3">
                            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Orders
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-12">
            <div class="card card-statistics">
                <a class="text-decoration-none text-dark fw-bold" href="{{route('admin.users', ['artisan'=>'artisan'])}}">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <i class="fa-5x fas fa-users-cog"></i>
                            </div>
                            <div class="float-end">
                                <p class="card-text text-end">Artisans</p>
                                <div class="fluid-container">
                                    <h6 class="card-title fw-bold text-end mb-0">{{$total_artisans}}</h6>
                                </div>
                            </div>
                        </div>
                        <p class="text-home mt-3">
                            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Artisans
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class='card'>
                <div class='card-body'>
                    <h3 class="fw-bold">Top Artisans</h3>
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr class="sticky-top">
                                    <th>S/N</th>
                                    <th>Artisan</th>
                                    <th>Occupation</th>
                                    <th>Skills</th>
                                    <th>Description</th>
                                    <th>Start Budget</th>
                                    <th>No. of Orders</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                $sn = 0;
                                @endphp

                                @foreach($result as $user)

                                @php
                                $sn +=1;
                                @endphp

                                <tr>
                                    <td>{{$sn}}</td>

                                    <td><a class="text-home" href='{{route('admin.users',['id'=>$user->id])}}'>{{optional($user->personalinformation)->fullname}}</a>
                                    </td>

                                    <td>{{optional($user->professionalinformation)->occupation}}</td>

                                    <td>{{optional($user->professionalinformation)->skills}}</td>

                                    <td>{{optional($user->professionalinformation)->description}}</td>

                                    <td>NGN {{number_format(optional($user->professionalinformation)->start_budget
                                        ?? 0)}}</td>

                                    <td><a class="btn home-color text-white btn-sm"
                                            href="{{route('admin.orders', ['artisan'=>$user->id])}}">{{$user->artisan_orders_count}}</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a class="btn home-color text-white btn-sm" href="{{route('admin.users', ['artisan'=>'artisan'])}}">All
                            Artisans</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.master>