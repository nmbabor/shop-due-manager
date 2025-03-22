@extends('backend.master')

@section('title', 'গ্রাহক এর বিবরণ')
@section('title_button')
    <a href="{{ route('customers.index') }}" class="btn bg-gradient-primary" >
        <i class="fas fa-list"></i>
        সব গ্রাহক দেখুন
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-min-padding">
                        <tr>
                            <td width="25%"><b>গ্রাহকের নাম:</b> {{ $customer->name }} </td>
                            <td><b>মোবাইল নাম্বার:</b> {{ $customer->mobile_no ?? '' }} </td>
                            <td><b>ওয়ার্ড:</b> {{ $customer->word_no }} </td>
                        </tr>
                        <tr>
                            <td><b>ঠিকানা:</b> {{ $customer->address }} </td>
                            <td><b>পিতার নাম:</b> {{ $customer->father_name }} </td>
                            <td><b>স্ট্যাটাস:</b> {{ $customer->status == 1 ? 'একটিভ' : 'ইনেক্টিভ' }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center"> <h5> <b>মোট বাকি:</b> <span class="text-danger"> {{ $currentDue }} টাকা </span> </h5> </td>
                        </tr>
                        
                    </table>
                </div>
                

                <div class="col-md-8 table-responsive">
                    <table class="table table-bordered table-striped table-hover table-min-padding">
                        <thead>
                            <tr class="text-center">
                                <th width="13%">তারিখ</th>
                                <th>বিবরণ</th>
                                <th width="15%">বাকি টাকা</th>
                                <th width="15%">জমা টাকা</th>
                                <th width="12%" class="text-center">---</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $data)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                                    <td>{{ $data->details }}</td>
                                    <td class="text-right">
                                        @if ($data->type == 'due')
                                            {{ $data->amount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if ($data->type != 'due')
                                            {{ $data->amount }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($lastId == $data->id)
                                        <div class="text-center">
                                            <!-- Button trigger modal -->
                                            <button title="ইডিট এন্ট্রি" type="button" class="btn btn-info btn-xs"
                                                data-toggle="modal" data-target="#editCategory-{{ $data->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Delete Data"
                                                href="javascript:void(0)"
                                                onclick='resourceDelete("{{ route('customers.ladger.delete', $data->id) }}")'>
                                                <span class="delete-icon">
                                                    <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editCategory-{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                {!! Form::open(['method' => 'put', 'route' => ['customers.ladger.update', $data->id]]) !!}
                                                
                                                @php 
                                                    $type = $data->type == 'due' ? 'বাকি' : 'জমা';
                                                @endphp
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            {{$type}} এন্ট্রি আপডেট
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="col-md-12"> তারিখ : </label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control singleDatePicker" placeholder="Date"
                                                                name="date" value="{{ date('d-m-Y',strtotime($data->date)) }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12"> বিবরণ : </label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" placeholder="বিবরণ" name="details">{{$data->details}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12"> {{$type}}র পরিমাণ (টাকা) : </label>
                                                        <div class="col-md-12">
                                                            <input type="number" class="form-control" placeholder="টাকার পরিমাণ" min="0" name="amount" value="{{$data->amount}}">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn bg-gradient-primary">
                                                            Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"> <i class="fa fa-plus-circle"></i> বাকি এন্ট্রি</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"> <i class="fa fa-minus-circle"></i> জমা এন্ট্রি</a></li>
                            
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                               <h6 class=""> নতুন বাকির হিসাব এন্ট্রি করুন</h6>
                               <hr>
                               <form action="{{ route('customers.ladger.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <input type="hidden" name="type" value="due">
                                <div class="form-group">
                                    <label class="col-md-12"> তারিখ : </label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control singleDatePicker" placeholder="Date"
                                            name="date" value="{{ date('d-m-Y') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">পণ্যের বিবরণ : </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="বাকি পণ্যের বিবরণ" name="details"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"> বাকির পরিমাণ (টাকা) : </label>
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" placeholder="টাকার পরিমাণ" min="0" name="amount">
                                    </div>
                                </div>
                                                            
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">
                                            বাকি সাবমিট করুন
                                        </button>
                                    </div>
                                </div>

                            </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                            <h6 class="text-success">টাকা জমা করুন</h6>
                            <hr>
                            <form action="{{ route('customers.ladger.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <input type="hidden" name="type" value="deposit">
                                <div class="form-group">
                                    <label class="col-md-12"> তারিখ : </label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control singleDatePicker" placeholder="Date"
                                            name="date" value="{{ date('d-m-Y') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">জমার বিবরণ : </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="জমার বিবরণ" name="details"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12"> জমার পরিমাণ (টাকা) : </label>
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" placeholder="টাকার পরিমাণ" min="0" name="amount">
                                    </div>
                                </div>
                                                            
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary">
                                            জমা সাবমিট করুন
                                        </button>
                                    </div>
                                </div>

                            </form>
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- ./card -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <fieldset class="border p-2">
                        <legend class="w-auto">নতুন বাকি এন্ট্রি করুন</legend>
                        
                    </fieldset>
                    <fieldset class="border p-2">
                        
                    </fieldset>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#totalMonths").on('keyup click blur', function() {
                let isChecked = $("#special_consider").prop("checked");
                if(!isChecked){
                    totalAmountCalculation()
                }
            });

            function totalAmountCalculation(){
                let totalMonths = parseInt($('#totalMonths').val());
                let amount = parseInt($('#monthly_amount').val());
                let total = totalMonths * amount;
                $("#payableAmounts").val(total);
            }

            $('#special_consider').change(function() {
                if (this.checked) {
                    $('#payableAmounts').val('0');
                } else {
                    totalAmountCalculation()
                }
            });
        });
    </script>
@endpush
