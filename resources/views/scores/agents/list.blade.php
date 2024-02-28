<?php

use carbon\carbon;

$dt = carbon::now();
$dt1 = carbon::now();
?>
@extends('layouts.dco-app')
@section('css')
<style>
    #scorecard_datatable {
        font-size: 14px !important;
    }

    th {
        text-align: center;
    }
</style>
@endsection
@section('content')
<h3><strong>AGENTS SCORECARD</strong></h3>

<div class="row" id="filterByMonth" style="display: none">
    <div class="col-md-offset-8 col-md-4">
        <div class="form-group">
            <label for="target">Filter by Month: </label>
            <form action="" method="GET" name="myform" id="myform">

                <select name="filter_month" required id="filter_month" class="form-control">
                    <option></option>
                    @foreach ($avail_months as $avail_month)
                    <option value="{{$avail_month->month}}">{{$avail_month->month}}</option>
                    @endforeach
                </select>

                @error('filter_month')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <button type="submit" class="btn btn-success bt-sm pull-right" style="margin-top: 10px">Go <i class="fa fa-chevron-circle-right"></i></button>
            </form>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 10px">
    <div class="col-md-10">

        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filters
            </button>
            <div class="dropdown-menu animated flipInY" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item" href="#" onclick="toggleMonthFilter()">By Month</a>

                @if(agentHasUnAcknowledgeCard() > 0 && \Auth::user()->isAgent())
                <a class="dropdown-item" style="background: #e81f37; color: white" href="{{url('scores/agent')}}?not_acknowledge">View Un Acknowledge Scorecards <span style="font-style: italic; font-size: 12px">({{agentHasUnAcknowledgeCard()}})</span></a>
                @else
                <a class="dropdown-item" href="{{url('scores/agent')}}?not_acknowledge">View Un Acknowledge Scorecards</a>

                @endif
                <a class="dropdown-item" href="{{url('scores/agent')}}?acknowledge">View Acknowledge Scorecards</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('scores/agent')}}?view_all">View All Scorecards</a>

            </div>
        </div>

        {{-- <a href="{{url('scores/agent')}}?view_all">
        <button title="Click to Filter Month" class="btn btn-sm btn-success waves-effect waves-light" type="button"><span class="btn-label"> <i class="mdi mdi-refresh"></i> </span>View All </button>
        </a> --}}
        {{-- <button onclick="toggleMonthFilter()" title="Click to Filter Month" class="btn btn-sm btn-primary waves-effect waves-light" type="button"><span class="btn-label"> <i class="fa fa-search"></i> </span>Month </button> --}}
    </div>
    @if(\Auth::user()->isAdmin())
    <div class="col-md-2 text-right">
        <button title="Create Scorcard" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#addAgentScore" type="button"><span class="btn-label"> <i class="mdi mdi-account-plus"></i> </span>Add </button>
    </div>
    @endif
</div>
<div class="row">

    <div class="col-md-12">
        @include('notifications.success')
        @include('notifications.error')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="scorecard_datatable" class="display nowrap table table-hover table-bordered dataTable " cellspacing="0" width="100%">
                        <thead style="background: #04b381; color: white; font-weight: bold">
                            <tr>
                                <th>Month</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th>Manager</th>
                                {{-- <th>Quality %</th>
                                     <th>Productivity %</th>
                                     <th>Reliability %</th>
                                     <th>Profit %</th>
                                     <th>People %</th> 
                                     <th>Parnership %</th>
                                     <th>Priority %</th>--}}
                                <th>Final Score</th>
                                <th>Status</th>
                                <th></th>
                                @if(Auth::user()->isAdmin())
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody> @foreach($scores as $score)
                            <tr>
                                <td class="table-dark-border" style="width: 150px; text-align: center">
                                    {{-- @if($score->acknowledge_by_agent == "0")
                            <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px" title="Not yet Acknowledge by {{ucwords($score->theagent->name)}}"></i>
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px" title="This Scorecard was Acknowledge by {{ucwords($score->theagent->name)}}"></i>
                                    @endif --}}

                                    @if(Auth::user()->isAdmin() || Auth::user()->isCBAOrTowerHead())
                                    @if($score->acknowledge_by_agent == "0" || $score->acknowledge_by_tl == "0" || $score->acknowledge_by_manager == "0")
                                    {{-- <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px"></i> --}}
                                    @if($score->acknowledge_by_tl == "0")
                                    <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px"></i>
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px"></i>
                                    @endif
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px"></i>
                                    @endif
                                    @elseif(Auth::user()->isAgent())
                                    @if($score->acknowledge_by_agent == "0")
                                    <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px"></i>
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px"></i>
                                    @endif
                                    @elseif(Auth::user()->isSupervisor())
                                    @if($score->acknowledge_by_tl == "0")
                                    <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px"></i>
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px"></i>
                                    @endif
                                    @elseif(Auth::user()->isManager())
                                    @if($score->acknowledge_by_manager == "0")
                                    <i class="fa fa-warning" style="color: #dd4b39; font-size: 16px"></i>
                                    @else
                                    <i class="mdi mdi-check-circle" style="color: #04b381; font-size: 16px"></i>
                                    @endif
                                    @endif


                                    <a href="{{url('scores/agent/show/' . $score->id)  }}" style="color: black;" title="Click to view Scorecard"> {{$score->month}} - {{ $score->month_type }} </a>
                                </td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->theagent->emp_id}}</td>
                                <td class="table-dark-border">{{ucwords($score->theagent->name)}}</td>
                                <td class="table-dark-border">
                                    @if($score->theagent->thedepartment)
                                    {{ucwords($score->theagent->thedepartment->department)}}
                                    @endif
                                </td>

                                <td class="table-dark-border">
                                    @if($score->theagent->thesupervisor)
                                    {{ucwords($score->theagent->thesupervisor->name)}}
                                    @endif
                                </td>

                                <td class="table-dark-border">
                                    @if($score->theagent->themanager)
                                    {{ucwords($score->theagent->themanager->name)}}
                                    @endif
                                </td>
                                {{-- <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->quality}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->productivity}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->reliability}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->profit}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->people}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->parnership}}</td>
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->priority}}</td> --}}
                                <?php
                                // $score_quality = $score->quality;
                                
                                $score_quality = getAgentQualityScore($score->actual_quality); //implement new quality performance range july 20, 2022
                                $score_productivity = $score->productivity;
                                $score_profit = getAgentProfitScore($score->actual_profit);
/*                                 $score_people = getAgentPeopleScore($score->actual_people); */
                                $score_engagement = getAgentPeopleEngScore($score->actual_engagement);
                                $score_behavior = getAgentPeopleBehScore($score->actual_behavior);
                                $score_partnership = getAgentPartnershipScore($score->actual_partnership);
                                $score_priority = getAgentPriorityScore($score->actual_priority);
                                $score_reliability = getAgentReliabilityScore($score->actual_reliability);
                                $final_score = $score_quality + $score_productivity + $score_reliability + $score_profit + $score_engagement + $score_behavior + $score_partnership + $score_priority;
                                ?>
                                {{-- <td class="table-dark-border" style="width: 150px; text-align: center">{{$score->final_score}}%</td> --}}
                                <td class="table-dark-border" style="width: 150px; text-align: center">{{ $final_score }}%</td>
                                @if($score->acknowledge > 0)
                                <td class="table-dark-border" style="width: 150px; text-align: center">Acknowledge</td>
                                @else
                                <td class="table-dark-border" style="width: 150px; text-align: center">Un Acknowledge</td>
                                @endif

                                @if(Auth::user()->isAdmin())
                                <td class="table-dark-border" style="width: 150px; text-align: center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu animated flipInY" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">

                                            <span class="dropdown-item text-center">
                                                <form method="GET" action="{{route('agent-score.edit', ['id' => $score->id])}}">
                                                    <button class="btn btn-sm btn-primary text-center">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </button>
                                                </form>
                                            </span>

                                            <span class="dropdown-item text-center">
                                                <form method="POST" action="{{route('agent-score.destroy', ['id' => $score->id])}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this score?')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                    <!--btn-group-->
                                </td>
                                @endif

                                <td class="table-dark-border" style="width: 150px; text-align: center">
                                    <form method="GET" action="{{route('agent-score.show', ['id' => $score->id])}}">
                                        <button type="submit" class="btn btn-sm btn-warning">View Scorecard</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- @include('scores.agents.edit_modal') --}}
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!--table-responsive-->

            </div>
            <!--card-body-->
        </div>
        <!--card-->
    </div>
    <!--col-md-12-->
</div>
<!--row-->

@endsection

@if(\Auth::user()->isAdmin())
@include('scores.agents.add_modal')
@endif

@section('js')
@include('js_addons')
<script>
    $(document).ready(function() {
        let table = $('#scorecard_datatable').DataTable({
            // @if(\Auth::user()->isAdmin()) "pageLength": 25, @endif
            "pagingType": "full_numbers",
            "order": [2, "asc"],
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 7]
                    }
                }

            ],
            "aoColumnDefs": [{ "bVisible": false, "aTargets": [7] }]


        });
    });
</script>

<script>
    function sumTotalScore() {

        // let quality = $("#quality").val();
        // let productivity = $("#productivity").val();
        // let reliability = $("#reliability").val();

        let q = $("#q").val();
        let p = $("#p").val();
        let r = $("#r").val();
        let pt = $("#pt").val();
        let e = $("#e").val();
        let b = $("#b").val();
        let ps = $("#ps").val();
        let py = $("#py").val();

        let actual_quality = $("#actual_quality").val();
        let actual_productivity = $("#actual_productivity").val();
        let actual_reliability = $("#actual_reliability").val();
        let actual_profit = $("#actual_profit").val();
        let actual_engagement = $("#actual_engagement").val();
        let actual_behavior = $("#actual_behavior").val();
        let actual_partnership = $("#actual_partnership").val();
        let actual_priority = $("#actual_priority").val();

        let quality = (q / 100) * actual_quality;
        let productivity = (p / 100) * actual_productivity;
        let reliability = (r / 100) * actual_reliability;
        let profit = (pt / 100) * actual_profit;
        let engagement = (e / 100) * actual_engagement;
        let behavior = (b / 100) * actual_behavior;
        let partnership = (ps / 100) * actual_partnership;
        let priority = (py / 100) * actual_priority;


        quality = isNaN(quality) ? 0 : quality;
        productivity = isNaN(productivity) ? 0 : productivity;
        reliability = isNaN(reliability) ? 0 : reliability;
        profit = isNaN(profit) ? 0 : profit;
        engagement = isNaN(engagement) ? 0 : engagement;
        behavior = isNaN(behavior) ? 0 : behavior;
        partnership = isNaN(partnership) ? 0 : partnership;
        priority = isNaN(priority) ? 0 : priority;

        quality = quality > q ? q : quality;
        productivity = productivity > p ? p : productivity;
        reliability = reliability > r ? r : reliability;
        profit = profit > pt ? pt : profit;
        engagement = engagement > e ? e : engagement;
        behavior = behavior > b ? b : behavior;
        partnership = partnership > ps ? ps : partnership;
        priority = priority > py ? py : priority;

        $("#q_val").val(parseFloat(quality).toFixed(2));
        $("#p_val").val(parseFloat(productivity).toFixed(2));
        $("#r_val").val(parseFloat(reliability).toFixed(2));
        $("#pt_val").val(parseFloat(profit).toFixed(2));
        $("#e_val").val(parseFloat(engagement).toFixed(2));
        $("#b_val").val(parseFloat(behavior).toFixed(2));
        $("#ps_val").val(parseFloat(partnership).toFixed(2));
        $("#py_val").val(parseFloat(priority).toFixed(2));

        $("#quality").html(parseFloat(quality).toFixed(2));
        $("#productivity").html(parseFloat(productivity).toFixed(2));
        $("#reliability").html(parseFloat(reliability).toFixed(2));
        $("#profit").html(parseFloat(profit).toFixed(2));
        $("#engagement").html(parseFloat(engagement).toFixed(2));
        $("#behavior").html(parseFloat(behavior).toFixed(2));
        $("#partnership").html(parseFloat(partnership).toFixed(2));
        $("#priority").html(parseFloat(priority).toFixed(2));


        let totalScore = parseFloat(quality) + parseFloat(productivity) + parseFloat(reliability) + parseFloat(profit) + parseFloat(engagement) + parseFloat(behavior) + parseFloat(partnership) + parseFloat(priority);
        $("#totalScoreLbl").html(parseFloat(totalScore).toFixed(2) + "%");
        $("#final_score").val(parseFloat(totalScore).toFixed(2));
        console.log(totalScore);
    }


    function toggleMonthFilter() {
        $("#filterByMonth").slideToggle();
    }
</script>
@endsection