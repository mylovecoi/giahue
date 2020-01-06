<?php

namespace App\Http\Controllers;

use App\DmGiaThueMuaNhaXh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmGiaThueMuaNhaXhController extends Controller
{
    public function index(){
        if(Session::has('admin')){
            $model = DmGiaThueMuaNhaXh::all();
            return view('manage.dinhgia.giathuemuanhaxh.danhmuc.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục nhóm giá thuê mua nhà xã hội');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = new DmGiaThueMuaNhaXh();
            $model->create($inputs);
            return redirect('danhmucgiathuemuanhaxh');
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = DmGiaThueMuaNhaXh::findOrFail($id);


        $result['message'] = '<div class="modal-body" id="edit-tt">';
        $result['message'] .= '<div class="row">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label class="control-label">Mã nhóm <span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="edit_manhom" id="edit_manhom" class="form-control" value="'.$model->manhom.'"/>';
        $result['message'] .= '</div></div>';
        $result['message'] .= '</div>';

        $result['message'] .= '<div class="row">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label class="control-label">Tên nhóm <span class="require">*</span></label>';
        $result['message'] .= '<textarea rows="4" cols="50" name="edit_tennhom" id="edit_tennhom" class="form-control">'.$model->tennhom.
            '</textarea>';
        $result['message'] .= '</div></div>';
        $result['message'] .= '</div>';
        $result['message'] .= '<input type="hidden" name="edit_id" id="edit_id" class="form-control" value="'.$model->id.'"/>';

        $result['message'] .= '</div>';
        $result['status'] = 'success';


        die(json_encode($result));
    }

    public function update(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['edit_id'];
            $inputs['manhom'] = $inputs['edit_manhom'];
            $inputs['tennhom'] = $inputs['edit_tennhom'];
            $model =  DmGiaThueMuaNhaXh::findOrFail($id);
            $model->update($inputs);
            return redirect('danhmucgiathuemuanhaxh');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model =  DmGiaThueMuaNhaXh::findOrFail($id);
            $model->delete();
            return redirect('danhmucgiathuemuanhaxh');
        }else
            return view('errors.notlogin');
    }
}
