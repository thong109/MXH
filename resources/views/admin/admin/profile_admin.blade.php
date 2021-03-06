@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="table-responsive">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form action="{{ URL::to('edit-admin-profile/' . Session::get('admin_id')) }}" method="POST">
                                    @csrf
                                    <div class="col-lg-4 col-md-5" style="padding: 0">
                                        <div class="card card-user">
                                            <div class="image" style="display: table-row-group;text-align: center;justify-content: center;">
                                                {{-- <img src="{{ asset('public/uploads/product/'.$profileAdmin->admin_avatar) }}" > --}}
                                                <img src="{{ asset('public/frontend/images/download.png') }}" >
                                                <input type="file" name="admin_avatar" style="text-align-last: center;margin-top:5px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control border-input" name="admin_email"
                                                    disabled="" value="{{ $profileAdmin->admin_email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>H??? t??n</label>
                                                <input type="text" class="form-control border-input" placeholder="H??? t??n"
                                                    name="admin_name" value="{{ $profileAdmin->admin_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>S??? ??i???n tho???i</label>
                                                <input type="text" name="admin_phone" class="form-control border-input"
                                                    placeholder="S??? ??i???n tho???i" value="{{ $profileAdmin->admin_phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>?????a ch???</label>
                                                <input type="text" class="form-control border-input" placeholder="?????a ch???"
                                                    name="admin_address" value="{{ $profileAdmin->admin_address }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd"
                                            name="updateAdminProfile">Update Profile</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
