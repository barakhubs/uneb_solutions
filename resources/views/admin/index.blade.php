@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-3">Dashboard</h1>
            <p>This dashboard displays a brief summary of the application</p>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-light rounded p-3">
                            <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                <div class="icon me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-file text-primary"></i>
                                </div>
                                <div>
                                    <strong>{{ number_format($totalResources) }}</strong><br>
                                    <span>Total Resources</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="bg-light rounded p-3">
                            <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                <div class="icon me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-download text-primary"></i>
                                </div>
                                <div>
                                    <strong>{{ number_format($totalDownloads) }}</strong><br>
                                    <span>Total Downloads</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-light rounded p-3">
                            <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                <div class="icon me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-money-bill text-primary"></i>
                                </div>
                                <div>
                                    <strong>UGX {{ number_format($totalSales) }}</strong><br>
                                    <span>Total Sales</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Downloads History</h6>
                            <table class="table table-hover justify-content-btn border">
                                <thead class="bg-info">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-end">Downloads</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Today</td>
                                        <td class="text-end">{{ $dToday }}</td>
                                    </tr>
                                    <tr>
                                        <td>Yesterday</td>
                                        <td class="text-end">{{ $dYesterday }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Week</td>
                                        <td class="text-end">{{ $dLastWeek }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last 30 days</td>
                                        <td class="text-end">{{ $dLastMonth }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Sales History</h6>
                            <table class="table table-hover justify-content-btn border">
                                <thead class="bg-warning">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-end">Downloads</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Today</td>
                                        <td class="text-end">234</td>
                                    </tr>
                                    <tr>
                                        <td>Yesterday</td>
                                        <td class="text-end">234</td>
                                    </tr>
                                    <tr>
                                        <td>Last Week</td>
                                        <td class="text-end">234</td>
                                    </tr>
                                    <tr>
                                        <td>Last 30 days</td>
                                        <td class="text-end">234</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-2">
                            <h6>Quick Links</h6>
                            <a href="{{ route('resource-index') }}" class="btn btn-info btn-sm mb-3">New Resource</a>
                            <a href="{{ route('tag-index') }}" class="btn btn-warning btn-sm mb-3">New Tag</a>
                            <a href="{{ route('class-index') }}" class="btn btn-secondary btn-sm mb-3">New Class</a>
                            <a href="{{ route('subject-index') }}" class="btn btn-primary btn-sm mb-3">New Subject</a>
                            <a href="#" class="btn btn-warning btn-sm">New User</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection