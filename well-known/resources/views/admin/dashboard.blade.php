
@extends('admin.layout.app')

@section('title')
    WabeStudio | Dashboard

@endsection

@section('content')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">

                <example-component></example-component>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-header-1">
                        <h1 class="main-content-title tx-30">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Analytics Dashboard</a></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->


                <!-- Row -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-primary-gradient overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex clearfix">
                                            <div class="text-left">
                                                <p class="mb-0 text-white fs-24">Total Sales</p>
                                                <h1 class="mb-0 text-white fs-30">200</h1>
                                                <p class="mb-0 text-white icon-service-1"><span class="text-white"><i class="fa fa-chevron-up text-white"></i> -64.4%</span></p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-primary icon-service1 text-white ">
														<i class="fe fe-shopping-bag"></i>

													</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{asset('back-assets/img/pngs/img-1.png')}}" alt="img" class="img-card-circle">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-secondary-gradient overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex clearfix">
                                            <div class="text-left">
                                                <p class="mb-0 text-white fs-24">HotSpot Users</p>
                                                <h1 class="mb-0 text-white fs-30">100</h1>
                                                <p class="mb-0 text-white icon-service-1"><span class="text-white"><i class="fa fa-chevron-up text-white"></i> +12.6%</span></p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-secondary icon-service1 text-white ">
														<i class=" fe fe-wifi"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{asset('back-assets/img/pngs/img-2.png')}}" alt="img" class="img-card-circle">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-purple-gradient overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex clearfix">
                                            <div class="text-left">
                                                <p class="mb-0 text-white fs-24">Total Profit</p>
                                                <h1 class="mb-0 text-white fs-30">KSh45,324</h1>
                                                <p class="mb-0 text-white icon-service-1"><span class="text-white"><i class="fa fa-chevron-down text-white"></i> -16.2%</span></p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-purple icon-service1 text-white">
														<i class="fas fa-coins"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="../../assets/img/pngs/img-2.png" alt="img" class="img-card-circle">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card bg-success-gradient overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex clearfix">
                                            <div class="text-left">
                                                <p class="mb-0 text-white fs-24">PPPOE Users</p>
                                                <h1 class="mb-0 text-white fs-30">0</h1>
                                                <p class="mb-0 text-white icon-service-1"><span class="text-white"><i class="fa fa-chevron-up text-white"></i> +356.6</span></p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-success icon-service1 text-white ">
														<i class="fe fe-user"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="../../assets/img/pngs/img-1.png" alt="img" class="img-card-circle">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header pd-t-20 bd-b-0">
                                <div class="d-md-flex justify-content-between">
                                    <h4 class="card-title font-weight-semibold mb-sm-3">Revenue</h4>
                                    <div class="dash2-select wd-150">
                                        <select name="coins" class="form-control custom-select select2">
                                            <option value="1">Year</option>
                                            <option value="2" selected>Week </option>
                                            <option value="3">Month</option>
                                            <option value="4">Day</option>
                                            <option value="5">Hours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 mb-0">
                                <div id="bar" class="sales-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

                <!-- ROW-2 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-8">
                        <div class="card overflow-hidden bd-b-0">
                            <div class="card-header  bd-b-0">
                                <div class="d-md-flex justify-content-between">
                                    <h4 class="card-title font-weight-semibold mb-sm-3">Statistics</h4>
                                    <div class="dash1-select wd-200 d-flex">
											<span class="input-icon-addon input-icon-addon border border-right-0 p-1 ht-38">
												<i class="fe fe-calendar fs-20 px-2"></i>
											</span>
                                        <select name="coins" class="form-control custom-select select2">
                                            <option value="1">YEAR</option>
                                            <option value="2">MONTH</option>
                                            <option value="3">WEEK</option>
                                            <option value="4">DAY</option>
                                            <option value="5">HOURS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pr-4 pl-5">
                                <div class="chart-wrapper">
                                    <canvas id="statistics" class="static-chart ht-345"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-header bd-b-0">
                                <h3 class="card-title font-weight-semibold ">summary</h3>
                            </div>
                            <div class="card-body mt-2 mb-3">
                                <div class="chart-wrapper">
                                    <canvas id="chart" class="chart-dropshadow2 ht-200  chartjs-render-monitor"></canvas>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-xl-6 col-6 col-md-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class="d-flex justify-content-center"><span class="legend chart-legend4 h-2 w-2 brround mr-3"></span><span>Orders</span></div>
                                    </div>
                                    <div class="col-xl-6 col-6 col-md-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><span class="legend chart-legend2 h-2 w-2 brround mr-3"></span><span>Profits</span></div>

                                    </div>
                                    <div class="col-xl-6 col-6 col-md-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class="d-flex justify-content-center mr-2"><span class="legend chart-legend1 h-2 w-2 brround mr-3"></span><span>Sales</span></div>

                                    </div>
                                    <div class="col-xl-6 col-6 col-md-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class="d-flex"><span class="legend chart-legend3 h-2 w-2 brround mr-3"></span><span>Exchange</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-2 END -->

                <!-- ROW-3 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="text-left">
                                                <p class="mb-1 text-dark fs-20 font-weight-medium">Customers</p>
                                                <h6 class="mb-1 text-primary fs-18 font-weight-semibold">Today</h6>
                                                <p class="mb-1 text-muted fs-16 font-weight-semibold">85,61,352</p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-primary icon-service2 text-white ">
														<i class="fe fe-users"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="text-left">
                                                <p class="mb-1 text-dark fs-20 font-weight-medium">Products</p>
                                                <h6 class="mb-1 text-secondary fs-18 font-weight-semibold">Today</h6>
                                                <p class="mb-1 text-muted fs-16 font-weight-semibold">$25,711,897</p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-secondary icon-service2 text-white ">
														<i class="fe fe-bar-chart-2"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-lg-6">
                                <div class="card ">
                                    <div class="card-body p-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="text-left">
                                                <p class="mb-1 text-dark fs-20 font-weight-medium">Max Supply</p>
                                                <h6 class="mb-1 text-purple fs-18 font-weight-semibold">Today</h6>
                                                <p class="mb-1 text-muted fs-16 font-weight-semibold">21,000</p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-purple icon-service2 text-white ">
														<i class="fe fe-trending-up"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="text-left">
                                                <p class="mb-1 text-dark fs-20  text-nowrap font-weight-medium">New Customers</p>
                                                <h6 class="mb-1 text-success fs-18 font-weight-semibold">Today</h6>
                                                <p class="mb-1 text-muted fs-16 font-weight-semibold">8,643</p>
                                            </div>
                                            <div class="ml-auto">
													<span class="bg-success icon-service2 text-white ">
														<i class="fe fe-users"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-3 END -->

                <!-- ROW-4 opened -->
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="card transcation-crypto" id="transcation-crypto">
                            <div class="card-header bd-b-0">
                                <h4 class="card-title font-weight-semibold mb-0">Top Orders</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap" id="example1">
                                            <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent">Product</th>
                                                <th class="bg-transparent">Date</th>
                                                <th class="bg-transparent">Product ID</th>
                                                <th class="bg-transparent">Amount</th>
                                                <th class="bg-transparent">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="border-bottom-0">
                                                <td class="coin_icon d-flex">
                                                    <div class="orders1"> <img alt="img" class="brround" src="../../assets/img/pngs/20.png"> </div>
                                                    <span class=" my-auto"> <b>MakeUp Kit</b></span>
                                                </td>
                                                <td class="text-muted fs-15 font-weight-semibold">25 jan 2020 10:15am</td>
                                                <td class="text-muted fs-15 font-weight-semibold">#3627</td>
                                                <td class="text-muted fs-15 font-weight-semibold">$1563</td>
                                                <td><a href="#" class="btn btn-primary btn-md wd-100">Paid</a></td>
                                            </tr>
                                            <tr class="border-bottom-0">
                                                <td class="coin_icon d-flex">
                                                    <div class="orders1"><img alt="img" class="brround" src="../../assets/img/pngs/21.png">  </div>
                                                    <span class=" my-auto"> <b>Shoes</b></span>
                                                </td>
                                                <td class="text-muted fs-15 font-weight-semibold">25 jan 2020 10:20am</td>
                                                <td class="text-muted fs-15 font-weight-semibold">#95688</td>
                                                <td class="text-muted fs-15 font-weight-semibold">$254</td>
                                                <td><a href="#" class="btn btn-warning btn-md wd-100">Pending</a></td>
                                            </tr>
                                            <tr class="border-bottom-0">
                                                <td class="coin_icon d-flex">
                                                    <div class="orders1"><img alt="img" class="brround" src="../../assets/img/pngs/22.png"> </div>
                                                    <span class=" my-auto"> <b>Kettle</b></span>
                                                </td>
                                                <td class="text-muted fs-15 font-weight-semibold">25 jan 2020 4:20am</td>
                                                <td class="text-muted fs-15 font-weight-semibold">#6254</td>
                                                <td class="text-muted fs-15 font-weight-semibold">$153</td>
                                                <td><a href="#" class="btn btn-primary btn-md wd-100">Paid</a></td>
                                            </tr>

                                            <tr class="border-bottom-0">
                                                <td class="coin_icon d-flex">
                                                    <div class="orders1"><img alt="img" class="brround" src="../../assets/img/pngs/23.png"> </div>
                                                    <span class=" my-auto"> <b>Grocery Items</b></span>
                                                </td>
                                                <td class="text-muted fs-15 font-weight-semibold">25 jan 2020 11:00pm</td>
                                                <td class="text-muted fs-15 font-weight-semibold">#354</td>
                                                <td class="text-muted fs-15 font-weight-semibold">$956</td>
                                                <td><a href="#" class="btn btn-danger btn-md wd-100">cancelled</a></td>
                                            </tr>
                                            <tr class="border-bottom-0">
                                                <td class="coin_icon d-flex">
                                                    <div class="orders1"><img alt="img" class="brround" src="../../assets/img/pngs/24.png"> </div>
                                                    <span class=" my-auto"> <b>Bicycle</b></span>
                                                </td>
                                                <td class="text-muted fs-15 font-weight-semibold">25 jan 2020 6:28am</td>
                                                <td class="text-muted fs-15 font-weight-semibold">#7375</td>
                                                <td class="text-muted fs-15 font-weight-semibold">$825</td>
                                                <td><a href="#" class="btn btn-warning btn-md wd-100">pending</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="transcation-crypto-1">
                            <div class="card-header bd-b-0">
                                <div class="d-flex">
                                    <h4 class="card-title font-weight-semibold mb-0">Wallet History</h4>
                                    <p class="text-muted fs-15 ml-auto">More</p>
                                </div>
                            </div>
                            <div class="card-body p-0 pt-1">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap" >
                                            <thead class="border-top">
                                            <tr>
                                                <th class="bg-transparent text-dark">S.no</th>
                                                <th class="bg-transparent text-dark">Name</th>
                                                <th class="bg-transparent text-dark">Date</th>
                                                <th class="bg-transparent text-dark">product</th>
                                                <th class="bg-transparent text-dark">Status</th>
                                                <th class="bg-transparent text-dark">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">01.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Jake poole</td>
                                                <td class="text-muted fs-15 font-weight-semibold">20-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Mobile</td>
                                                <td class="text-success fs-15 font-weight-semibold">Success</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">02.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Virginia Gray</td>
                                                <td class="text-muted fs-15 font-weight-semibold">20-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Clothes</td>
                                                <td class="text-success fs-15 font-weight-semibold">Success</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">03.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Jacob Thomson</td>
                                                <td class="text-muted fs-15 font-weight-semibold">20-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Burger</td>
                                                <td class="text-primary fs-15 font-weight-semibold">Pending</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">04.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Trevor Thomson</td>
                                                <td class="text-muted fs-15 font-weight-semibold">19-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Water Bottles</td>
                                                <td class="text-success fs-15 font-weight-semibold">success</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">05.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Kylie north</td>
                                                <td class="text-muted fs-15 font-weight-semibold">19-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Speakers</td>
                                                <td class="text-primary fs-15 font-weight-semibold">Pending</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">06.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Jan Hodges</td>
                                                <td class="text-muted fs-15 font-weight-semibold">19-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Cricket Bat </td>
                                                <td class="text-danger fs-15 font-weight-semibold">Cancel</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td class="text-muted fs-15 font-weight-semibold">07.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Trevor Thomson</td>
                                                <td class="text-muted fs-15 font-weight-semibold">19-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Shoes</td>
                                                <td class="text-success fs-15 font-weight-semibold">success</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <td class="text-muted fs-15 font-weight-semibold">08.</td>
                                                <td class="text-dark fs-15 font-weight-semibold">Emily Lewis</td>
                                                <td class="text-muted fs-15 font-weight-semibold">19-11-2020 </td>
                                                <td class="text-dark fs-15 font-weight-bold">Sanitizer</td>
                                                <td class="text-danger fs-15 font-weight-semibold">Cancel</td>
                                                <td class="">
                                                    <a class="btn btn-outline-info btn-sm rounded-11 mr-2" data-toggle="tooltip" data-original-title="Edit"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"/></svg></i></a>
                                                    <a class="btn btn-outline-danger btn-sm rounded-11" data-toggle="tooltip" data-original-title="Delete"><i><svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"/></svg></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-header bd-b-0">
                                <h4 class="card-title font-weight-semibold mb-0">Activity</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    <ul class="task-list" id="task-list">
                                        <li class="task-icon1">
                                            <div class="task-icon-1"> <i class="fe fe-shopping-bag text-primary"></i> </div>
                                            <h6>New Sale<span class="float-right fs-15 text-muted">just now</span></h6>
                                            <p class="text-muted fs-15">Hair Dyer</p>
                                        </li>
                                        <li class="task-icon2">
                                            <div class="task-icon-1"> <i class="fe fe-mail text-purple"></i> </div>
                                            <h6>Mail<span class="float-right fs-15 text-muted">5 mins ago</span></h6>
                                            <p class="text-muted fs-15">From</p>
                                        </li>
                                        <li class="task-icon3">
                                            <div class="task-icon-1"> <i class="fe fe-user text-pink"></i> </div>
                                            <h6>New Customer<span class="float-right fs-15 text-muted">7 mins ago</span></h6>
                                            <p class="text-muted fs-15">Create Account</p>
                                        </li>
                                        <li class="task-icon4">
                                            <div class="task-icon-1"> <i class="fe fe-dollar-sign text-danger"></i> </div>
                                            <h6>Transaction Success<span class="float-right fs-15 text-muted">1 hour ago</span></h6>
                                            <p class="text-muted fs-15">Jhon Dee A/c 154256...</p>
                                        </li>
                                        <li class="task-icon5">
                                            <div class="task-icon-1"> <i class="fe fe-trending-up text-info"></i> </div>
                                            <h6>Updated<span class="float-right fs-15 text-muted">1 hour ago</span></h6>
                                            <p class="text-muted fs-15">Updated 4.2 version</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pd-t-20 bd-b-0">
                                <div class="d-md-flex justify-content-between">
                                    <h4 class="card-title font-weight-semibold mb-sm-3">Earnings</h4>
                                    <div class="dash2-select  wd-150">
                                        <select name="coins" class="form-control custom-select select2">
                                            <option value="0" selected>Filter</option>
                                            <option value="1">Year</option>
                                            <option value="2">Month</option>
                                            <option value="3">Week</option>
                                            <option value="4">Day</option>
                                            <option value="5">Hour</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 mb-0">
                                <div class="mb-5">
                                    <canvas id="chartArea-1" class="ht-150 w-100"></canvas>
                                </div>
                                <div class="row pl-2 pr-2">
                                    <div class="col-xl-6 col-md-3 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><div class="table-earning1 bg-primary"> <i class="fe fe-calendar text-white"></i> </div><div class="earnings1"><h5 class="fs-18">Today</h5><p class="text-success fs-18 font-weight-semibold">122.13</p></div></div>
                                    </div>
                                    <div class="col-xl-6 col-md-3 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><div class="table-earning1 bg-secondary"> <i class="fe fe-shopping-bag text-white"></i> </div><div class="earnings1"><h5 class="fs-18">This Week</h5><p class="text-success fs-18 font-weight-semibold">16.23</p></div></div>
                                    </div>
                                    <div class="col-xl-6 col-md-3 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><div class="table-earning1 bg-purple"> <i class="fe fe-dollar-sign text-white"></i> </div><div class="earnings1"><h5 class="fs-18">Month</h5><p class="text-danger fs-18 font-weight-semibold">2.23</p></div></div>
                                    </div>
                                    <div class="col-xl-6 col-md-3 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><div class="table-earning1 bg-success"> <i class="fe fe-user text-white"></i> </div><div class="earnings1"><h5 class="fs-18">Year</h5><p class="text-success fs-18 font-weight-semibold">89.1</p></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pd-t-20 bd-b-0">
                                <div class="d-md-flex justify-content-between">
                                    <h4 class="card-title font-weight-semibold mb-sm-3">Vistors</h4>
                                    <div class="dash2-select  wd-150">
                                        <select name="coins" class="form-control custom-select select2">
                                            <option value="0" selected>Week</option>
                                            <option value="1">Sunday</option>
                                            <option value="2">Monday</option>
                                            <option value="3">Tuesday</option>
                                            <option value="4">Wednesday</option>
                                            <option value="5">Friday</option>
                                            <option value="5">Saturday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4 mb-0">
                                <div class="row">
                                    <div class="col-xl-5 col-4 col-md-3 col-lg-4 mt-2 mt-xl-0">
                                        <h6 class="mb-2 fs-18">Weekly</h6>
                                        <span class="text-muted fs-15 font-weight-semibold">41,426</span>
                                        <p class="m-0 fs-18 text-purple"><i class="fa fa-arrow-up mr-2"></i>6.13%</p>
                                    </div>
                                    <div class="col-xl-7 col-8 col-md-9 col-lg-8 mt-2 mt-xl-0">
                                        <canvas id="statistics-1" class="w-100 ht-100"></canvas>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><span class="legend bg-purple h-2 w-2 brround mr-3"></span><span>This Week</span></div>
                                    </div>
                                    <div class="col-xl-6 col-6 col-lg-3 mt-2 mt-xl-0">
                                        <div class=" d-flex"><span class="legend bg-dark h-2 w-2 brround mr-3"></span><span>Last week</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-4 END -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->
@endsection
