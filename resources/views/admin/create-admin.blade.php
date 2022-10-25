<x-layout.master>
    <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <x-page-header header="{{!empty($admin) ? 'Update Admin': 'Create Admin' }}"></x-page-header>

                <hr/>
                <form action="{{route('admin.create.post')}}" id="form" method="post">
                    <div class="row mt-3">
                        <div class="col-6">
                            <label>First Name<span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-lg borderless-input" autocomplete
                                value="{{!empty($admin) ? $admin->name['firstname'] : null}}" name="firstname" />
                        </div>

                        <div class="col-6">
                            <label>Last Name<span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-lg borderless-input" autocomplete
                                value="{{!empty($admin) ? $admin->name['lastname'] : null}}" name="lastname" />
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col-12">
                            <label>Role<span style="color:red;">*</span></label>
                            <select class="form-control form-control-lg" required="required" name="role">
                                <option {{(!empty($admin) and ($admin->role == "super_admin")) ? 'selected' : null}} value="super_admin">Super Admin</option>
                                <option {{(!empty($admin) and ($admin->role == "regular")) ? 'selected' : null}} value="regular">Regular Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6 col-xs-12">
                            <label>Email<span style="color:red;">*</span></label>
                            <input type="email" class="form-control form-control-lg borderless-input" autocomplete
                                value="{{!empty($admin) ? $admin->email : null}}" name="email" />
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <label>Create Password<span style="color:red;">*</span></label>
                            <div class="input-group form-group input-lg mb-3">
                                <input type="password"
                                    class="form-control form-control-lg signup-field borderless-input"
                                    placeholder="password" id="password" name="password" v-model="state.form.password">
                                <div class="bg-dark input-group-text">
                                    <a class="text-light password-visibility" data-id='password' href="#">
                                        <i class="fas fa-eye-slash "></i>
                                    </a>
                                </div>
                                <div class="bg-dark input-group-text">
                                    <button data-strength="decent_pw" data-target="password"
                                        class="text-light btn btn-sm gen-password">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($admin))
                    <input type="hidden" value="{{$admin->id}}" name="id" />
                    @endif

                    <div class="form-group mt-3">
                        <input class="btn home-color text-white btn-lg w-100" type="submit" value="{{!empty($admin) ? " Update Admin": "Create Admin" }}" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</x-layout.master>