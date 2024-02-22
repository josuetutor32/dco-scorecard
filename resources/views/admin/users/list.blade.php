@extends('layouts.dco-app')
@section('css')
<style>
#scorecard_datatable{
    font-size: 14px !important;
}
</style>
@endsection
@section('content')
<h3><strong>USERS LIST</strong></h3>

<div class="row" style="margin-bottom: 10px">
    <div class="col-md-12 text-right">
        <button title="Add User" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#addUser" type="button"><span class="btn-label"> <i class="mdi mdi-account-plus"></i> </span>Add </button>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
        @include('notifications.success')
        @include('notifications.error')
        <div class="card">
            <div class="card-body">
            <div class="table-responsive">
            <table id="scorecard_datatable" class="display nowrap table table-hover table-bordered dataTable " cellspacing="0" width="100%">
                <thead  style="background: #04b381; color: white; font-weight: bold">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Supervisor</th>
                        <th>Manager</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                    <td class="table-dark-border">{{$user->emp_id}}</td>
                    <td class="table-dark-border">{{ucwords($user->name)}}</td>
                    <td class="table-dark-border">{{($user->email)}}</td>

                    <td class="table-dark-border">@if($user->theposition){{ucwords($user->theposition['position'])}}@endif</td>
                    <td class="table-dark-border">@if($user->thedepartment){{ucwords($user->thedepartment['department'])}}@endif</td>
                    <td class="table-dark-border">@if($user->thesupervisor){{ucwords($user->thesupervisor['name'])}}@endif</td>
                    <td class="table-dark-border">@if($user->themanager){{ucwords($user->themanager['name'])}}@endif</td>

                    <td class="table-dark-border">{{ucwords($user->role)}}</td>
                    <td class="table-dark-border">{{ucwords($user->status)}}</td>
                    <td class="table-dark-border" style="width: 150px; text-align: center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu animated flipInY" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 50px; will-change: transform;">

                                    <span class="dropdown-item text-center">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$user->id}}"><i class="fa fa-edit"></i> Edit</button>

                                    </span>

                                   <span class="dropdown-item text-center">
                                    <form method="POST" action="{{route('users.destroy', ['id' => $user->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete, {{$user->role}}?')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</button>
                                    </form>
                                    </span>
                                </div>
                            </div><!--btn-group-->
                    </td>
                    </tr>

                    @include('admin.users.edit_modal')
                    @endforeach
                </tbody>
            </table>
        </div><!--table-responsive-->

            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-md-12-->
</div><!--row-->

@endsection

@include('admin.users.add_modal')

@section('js')
@include('js_addons')
<script>
        $(document).ready(function() {
         var table = $('#scorecard_datatable').DataTable( {
            // @if(\Auth::user()->isAdmin()) "pageLength": 25, @endif
            "pagingType": "full_numbers",
            "order": [[ 1, "asc" ]],
              orderCellsTop: true,
              fixedHeader: true,
              dom: 'Bfrtip',
              buttons: [
                  'excel', 'print'
              ],



          } );
      } );

    function userDetails()
    {
        $('#personiv_employee_searcing_label').fadeOut('').fadeIn();
        $('#personiv_employee_searcing_label').html('');
        $('#personiv_employee_searcing_label').html('Employee Searching...');
        var search_key = $('#personiv_employee_emp_code').val();
        $.ajax({
                type:'GET',
                url:"{{url('user/api/users/details')}}",
                dataType: 'json',
                data: {search_key: search_key},
                success:function(result)
                {

                    if(result.found)
                    {
                        console.log(result);
                        $('#personiv_employee_searcing_label').fadeOut();
                        $('#first_name').html(result.first_name);
                        $('#middle_name').html(result.middle_name);
                        $('#last_name').html(result.last_name);
                        $('#employee_name_label').fadeIn();

                    }else{
                        $('#first_name').html("");
                        $('#middle_name').html("");
                        $('#last_name').html("");
                        $('#employee_name_label').fadeOut();
                    }
                }
        })//Ajax
    }
</script>
@endsection
