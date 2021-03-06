<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/laydate/laydate.js') }}"></script>
@extends('app')

@section('htmlheader_title')
    Home
@endsection

@section('contentheader_title','会员申请列表')



@section('main-content')

    <style>
        .box-header > .box-tools2 {
            position: absolute;
            right: 500px;
            top: 5px;
        }
        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
        	padding-left:0;
        	padding-right:0;
        }
<!--
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	line-height: 54px;
}
-->        
    </style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <br><br>
                    <div class="box-tools2 ">
                        <form class="form-horizontal" action="{{url('memberapply/list')}}" method="get">
                            <div style="width: 800px;" class="input-group input-group-sm row">
                                <div class="col-lg-2">{{----}}
                                    <select name="grade"  class="form-control  " style="float:left;">
                                        <option value="">申请类型</option>
                                      {{--  <option value="1" >普通会员</option>--}}
                                        <option value="2">红卡会员</option>
                                        <option value="3">金卡会员</option>
                                        <option value="4">白金卡会员</option>
                                        <option value="5">黑卡会员</option>


                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select name="state"  class="form-control  " style="float:left;">
                                        <option value="">申请状态</option>
                                        <option value="0">未处理</option>
                                        <option value="1">已处理</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text"  placeholder=" 申请起始日期" id="start" class="inline laydate-icon form-control" style="float:left;" name="start" value="{{ $_GET['start'] or ''}}">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" placeholder="申请结束日期" id="end" class="inline laydate-icon form-control" style="float:left;" name="end" value="{{ $_GET['end'] or ''}}">
                                </div>

                                <div class="col-lg-4">
                                    <input type="hidden" name="search" value="1">
                                    <input type="text" placeholder="联系电话" class="form-control  " style="float:left;width:227px" name="mobile" value="{{ $_GET['mobile'] or ''}}">
                                    <button class="btn btn-default" style="float:right;height: 34px;" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>申请类型</th>
                            <th>邀请人</th>
                            <th>申请人</th>
                            <th>联系人</th>
                            <th>联系电话</th>
                            <th>申请时间</th>
                            <th >状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach ($data as $apply)
                            <tr>
                                <td>{{ $apply->id }}</td>
                                <td>{{ $apply->grade }}</td>
                                <td>{{ $apply->code }}</td>
                                <td>{{ $apply->membername }}/{{$apply->membermobile}}</td>
                                <td>{{ $apply->username }}</td>
                                <td>{{ $apply->mobile }}</td>
                                <td>{{ $apply->created_at }}</td>
                                <td>@if ($apply->state == 0) 未处理
                                    @else 已处理
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('memberapply/edit',['id'=>$apply->id]) }}"><button class="btn bg-orange margin" type="button">编辑</button></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $data->render() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <script>
        laydate({
            elem: '#start', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
            event: 'focus' //响应事件。如果没有传入event，则按照默认的click
        });
        laydate({
            elem: '#end', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
            event: 'focus' //响应事件。如果没有传入event，则按照默认的click
        });
    </script>
@endsection
