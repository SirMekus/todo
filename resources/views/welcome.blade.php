<x-layout.general>

    <x-nav></x-nav>

<header class="text-center">
    <div class="container-fluid p-5 bg-white">
        <div class="row">
            <div class='col-lg-12  mx-auto row'>
                <div class='col-lg-7'>
                    <h1 style="font-size:3.4rem;" class='fw-bolder'>Did You Know?</h1>
                    <p class="fs-2 fw-bold">Welcome To Our To-do Planner And Administration Software</p>
                </div>
                <div class='col-lg-5'>
                    <div>
                        <img class='img-fluid' src="{{asset('storage/for_site/staff.webp')}}">
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('login')}}" class='btn mt-3 p-3 btn-primary fw-bold' >Login</a>
    </div>
</header>
</x-layout.general>