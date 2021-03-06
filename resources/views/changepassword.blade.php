<script src="{{ asset('/js/jquery.min.js') }}"></script>
@extends('app')

@section('htmlheader_title')
    Home
@endsection
    

@section('main-content')
         
 
    @if(count($errors))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> 错误!</h4>
            @if(is_object($errors))
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            @else
                <p>{{$errors}}</p>
            @endif
        </div>
    @endif
            
<div class="box box-info">
            <!-- /.box-header -->
            <!-- form start -->

             	@section('contentheader_title','修改后台密码')
             	<form class="form-horizontal" action="{{ url('manage/managepasswordsave') }}" method="post"  >
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" >普通管理员密码(shuangchuang)</label>
                  <div class="col-sm-10">
                    <input type="text"  name="pad_password"  placeholder="Enter ..." class="form-control" value="">
                  </div>
                </div>                                                                                                                                                                                                                                          
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" >财务密码(caiwuyuan)</label>
                  <div class="col-sm-10">
                    <input type="text"  name="cai_password"  placeholder="Enter ..." class="form-control" value="">
                  </div>
                </div>                                                                                                                                                                                                                                          
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" >售后密码(shouhouyuan)</label>
                  <div class="col-sm-10">
                    <input type="text"  name="shou_password"  placeholder="Enter ..." class="form-control" value="">
                  </div>
                </div>                                                                                                                                                                                                                                          
              </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >招商密码(zhaoshang)</label>
                            <div class="col-sm-10">
                                <input type="text"  name="zhao_password"  placeholder="Enter ..." class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
              <div class="box-footer">
             
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />                
                <button class="btn btn-info pull-right" type="submit">提交</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
@endsection
