@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            $(":input").inputmask();
        });

        $(function(){
            $('#nam').change(function() {
                var nam = '&nam='+$('#nam').val();
                var url = '/giaspdvci?'+nam;
                window.location.href = url;
            });
        });

        function getId(id) {
            document.getElementById("destroy_id").value=id;
        }
        function getIdCb(id) {
            document.getElementById("congbo_id").value=id;
        }
        function getIdHcb(id) {
            document.getElementById("huycongbo_id").value=id;
        }

        function clickhoanthanh(){
            $('#frm_hoanthanh').submit();
        }

        function clickhuyhoanthanh(){
            $('#frm_huyhoanthanh').submit();
        }

        function getIdHt(id) {
            document.getElementById("idhoanthanh").value=id;
        }
        function getIdHHt(id) {
            document.getElementById("idhuyhoanthanh").value=id;
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
         Thông tin<small>&nbsp;Giá sản phẩm, dịch vụ công ích, dịch vụ sự nghiệp công và hàng hóa, dịch vụ được địa phương đặt hàng, giao kế hoạch sản xuất,
            kinh doanh sử dụng ngân sách địa phương theo quy định của pháp luật</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(can('kkgiaspdvci','create'))
                            <a href="{{url('giaspdvci/create')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Thêm mới </a>
                        @endif
                    </div>
                </div>
                <hr>

                <div class="portlet-body">
                    <div class="row">
                        <div class="portlet-body form" id="form_wizard">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Năm</label>
                                            <select class="form-control" name="nam" id="nam">
                                                <option value="all">--Tất cả các năm--</option>
                                                @if ($nam_start = 2015 ) @endif
                                                @if ($nam_stop = intval(date('Y')) + 1) @endif
                                                @for($i = $nam_start; $i <= $nam_stop; $i++)
                                                    <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Số Quyết định</th>
                                <th style="text-align: center">Ngày áp dụng</th>
                                <th style="text-align: center">Thông tin quyết định</th>
                                <th style="text-align: center"  width="5%"> Trạng thái</th>
                                <th style="text-align: center" width="23%"> Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key => $tt)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td style="text-align: center">{{$tt->soqd}}</td>
                                    <td style="text-align: center;"><b>{{getDayVn($tt->ngayqd)}}</b></td>
                                    <td style="text-align: left">{{$tt->ttqd}}</td>
                                    <td style="text-align: center">
                                        @if($tt->trangthai == 'CB')
                                            <span class="badge badge-warning">Công bố</span>
                                        @elseif($tt->trangthai == 'CHT')
                                            <span class="badge badge-danger">Chưa hoàn thành</span>
                                        @else
                                            <span class="badge badge-blue">Hoàn thành</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('giaspdvci/'.$tt->id)}}" class="btn btn-default btn-xs mbs" target="_blank"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                        @if($tt->trangthai == 'CB')
                                            {{--Công bố--}}
                                            @if(can('thgiaspdvci','congbo'))
                                                <button type="button" onclick="getIdHcb('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#huycongbo-modal" data-toggle="modal" style="margin: 2px"><i class="fa fa-times"></i>&nbsp;Hủy công bố</button>
                                            @endif
                                        @elseif($tt->trangthai == 'CHT')
                                            {{--Chưa hoàn thành--}}
                                            @if(can('kkgiaspdvci','edit'))
                                                <a href="{{url('giaspdvci/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                            @endif
                                            @if(can('kkgiaspdvci','delete'))
                                                <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#destroy-modal" data-toggle="modal" style="margin: 2px"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                            @endif
                                            @if(can('kkgiaspdvci','approve'))
                                                <button type="button" onclick="getIdHt('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#hoanthanh-modal" data-toggle="modal" style="margin: 2px"><i class="fa fa-send"></i>&nbsp;Hoàn thành</button>
                                            @endif
                                        @else
                                            {{--Hoàn thành--}}
                                            @if(can('thgiaspdvci','congbo'))
                                                <button type="button" onclick="getIdCb('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal" style="margin: 2px"><i class="fa fa-send"></i>&nbsp;Công bố</button>
                                                <button type="button" onclick="getIdHHt('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#huyhoanthanh-modal" data-toggle="modal" style="margin: 2px"><i class="fa fa-times"></i>&nbsp;Hủy Hoàn thành</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <!-- BEGIN DASHBOARD STATS -->

        <!-- END DASHBOARD STATS -->
        <div class="clearfix"></div>

    </div>

    @include('manage.dinhgia.giaspdvci.include.modal_dialog')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop