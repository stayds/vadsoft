@extends('layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>STAFF</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="First name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Last name">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Inputemail">Email</label>
                                    <input type="email" class="form-control" id="Inputemail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-4">
                                    <label for="inputState">Gender</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="StaffNo">Staff Number</label>
                                    <input type="email" class="form-control" id="StaffNo" placeholder="Staff number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="grade">Grade/Level</label>
                                    <input type="text" class="form-control" id="grade" placeholder="Grade/Level">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="Jtitle">Job title</label>
                                    <input type="text" class="form-control" id="Jtitle" placeholder="Job title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jd">Job Description</label>
                                    <input type="text" class="form-control" id="jd" placeholder="Job description">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="inputState">Department</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Select...</option>
                                        <option>Marketing</option>
                                        <option>Operations</option>
                                        <option>Accounting</option>
                                        <option>Administration</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Will this staff receive the assesment link for this department</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City/Town (office location)</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">State (office location)</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Abuja</option>
                                        <option>Lagos</option>
                                    </select>
                                </div>
                            </div>
                          <button type="submit" class="btn btn-primary mt-3 btn-lg">Add Staff</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection