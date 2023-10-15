@extends('backend.master')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$projects}}</h3>
                            <p>Total Completed Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('projects.create')}}" class="small-box-footer">
                            <i class="fas fa-plus-circle"></i>
                            Add new project
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>৳ {{ number_format($collection)}}</h3>
                            <p>{{date('M, Y')}} Collections</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($users)}}</h3>
                            <p>Total Active Member</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('backend.admin.user.create')}}" class="small-box-footer">
                            <i class="fas fa-plus-circle"></i>
                            Add new member
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>৳ {{ number_format($expense)}}</h3>
                            <p>Total Expense Amount</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->


            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Members Due Amount</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="2%">#</th>
                                            <th>Member Name</th>
                                            <th>Country</th>
                                            <th>Mobile No</th>
                                            <th>Amount</th>
                                            <th>Due Month</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach ($users as $user)
                                            @if (count($user->dueMonths()) > 0)
                                                @php $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td @if (count($user->dueMonths()) > 3) class="text-danger" @endif>{{ $user->name }}</td>
                                                    <td>{{ $user->country->name ?? '' }}</td>
                                                    <td>{{ $user->mobile_no }}</td>
                                                    <td>{{ $user->monthly_amount }}</td>
                                                    <td>
                                                        ({{count($user->dueMonths())}})
                                                        @foreach ($user->dueMonths() as $due)
                                                            <span class="badge badge-danger"> {{ date('M, Y', strtotime($due)) }} </span>
                                                        @endforeach
                                                    </td>
                                                    <td><a href="{{ route('deposit.user-details', $user->id) }}" class="btn btn-info"> <i
                                                                class="fa fa-eye"></i> </a> </td>
                                                </tr>
                                            @endif
                                        @endforeach
            
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
