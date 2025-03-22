@extends('backend.master')

@section('title', 'সকল গ্রাহক এর লিস্ট')
@section('title_button')
<a href="{{ route('customers.create') }}" class="btn bg-gradient-primary" >
    <i class="fas fa-plus"></i>
   গ্রাহক তৈরি করুন
</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table id="datatables" class="table table-hover">
                <thead>
                    <tr>
                        <th data-orderable="false">#</th>
                        <th>গ্রাহকের নাম</th>
                        <th>ঠিকানা</th>
                        <th>ওয়ার্ড</th>
                        <th>মোট বাকি</th>
                        <th width="10%" data-orderable="false">
                            ---
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            let table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                order: [
                    [1, 'asc']
                ],
                ajax: {
                    url: "{{ route('customers.index') }}"
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }
                    , {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address',
                    },
                    {
                        data: 'word_no',
                        name: 'word_no',
                    },
                    {
                        data: 'total_due',
                        name: 'total_due',
                    },
                    
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endpush