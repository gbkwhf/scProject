<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 11:53
 */

namespace App\Http\Controllers\BackManage;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


/**
 * Class CommodyCLaManController
 * @package App\Http\Controllers\BackManage
 * 商品分类管理
 */
class CommodyCLaManController extends Controller{


    //获取分类列表
    public function comClasManList(Request $request){


        $first_info = \DB::table('ys_goods_class')->where('first_id',0)->orderBy('sort','asc')->get();


        if(empty($first_info)){//未找到分类信息在ys_goods_class表
            return back() -> with('errors','未找到一级分类信息');

        }


        $common_class_list = \DB::table('ys_goods_class as a')
                              ->leftjoin('ys_goods_type as b','a.goods_type','=','b.id')
                              ->select('a.*','b.name as type_name')
                              ->orderBy('a.sort','asc');

        $search=[];
        if($request->first_id != ''){

            $common_class_list = $common_class_list->where('a.first_id',$request->first_id)->paginate(10);
            $num  = \DB::table('ys_goods_class')->select('*')->where('first_id',$request->first_id)->orderBy('sort','asc')->get();
            $search['first_id']=$request->first_id;

        }else{

                $common_class_list = $common_class_list->where('a.first_id',$first_info[0]->id)->paginate(10);

                $num  = \DB::table('ys_goods_class')->select('*')->where('first_id',$first_info[0]->id)->orderBy('sort','asc')->get();

        }

        return view('commonClassList',['data'=>$common_class_list,'num'=>$num,'search'=>$search,'first_info'=>$first_info]);


    }



   //编辑商品分类
    public function comClasManEdit($id){

        //一级分类信息
        $first_info = \DB::table('ys_goods_class')->where('first_id',0)->orderBy('sort','asc')->get();

        if(empty($first_info)){//未找到分类信息在ys_goods_class表

            return back() -> with('errors','未找到一级分类信息');
        }

        //关联类型信息
        $type_info = \DB::table('ys_goods_type')->orderBy('sort','asc')->get();

        if(empty($type_info)){//未找到类型信息
            return back() -> with('errors','未找到类型信息');
        }

        //需要被编辑的数据
        $data = \DB::table('ys_goods_class')->where('id',$id)->first();

        return view('commonClassEdit',['data'=>$data,'type_info'=>$type_info,'first_info'=>$first_info]);

    }

    //编辑商品分类保存
    public function comClasManEditSave(Request $request)
    {


        //查看是否有需要更新的值
       $is_hava  = \DB::table('ys_goods_class')->where('id',$request->id)->where('name',$request->class_name)
                   ->where('first_id',$request->first_id_value)->where('sort',$request->sort)->where('goods_type',$request->goods_type)->first();

        if(empty($is_hava)){ //表示有需要被更新的数据


            $res = \DB::table('ys_goods_class')->where('id',$request->id)->update([

                    'name'=>$request->class_name,
                    'first_id'=>$request->first_id_value,
                    'sort'=>$request->sort,
                    'goods_type'=>$request->goods_type

            ]);

            if($res){
                return redirect('commody/class/manage/list');
            }else{
                return back() -> with('errors','数据更新失败');
            }
        }

    }


    //删除商品分类
    public function comClasManDel($id){

        \DB::table('ys_goods_class')->where('id',$id)->delete();
        return redirect('commody/class/manage/list');

    }



    //获取一级分类列表
    public function comClasManFirList(){


        $first_info = \DB::table('ys_goods_class')->where('first_id',0)->orderBy('sort','asc')->get();

        if(empty($first_info)){//未找到分类信息在ys_goods_class表
            return back() -> with('errors','未找到一级分类信息');
        }

        return view('commonClassFirList',['data'=>$first_info,'num'=>$first_info]);

    }


    //添加一级商品分类
    public function comClasManFirAdd(){


        return view('commonClassFirAdd');


    }

    //保存一级商品分类添加信息
    public function comClasManFirSave(Request $request)
    {

        $res = \DB::table('ys_goods_class')->insert([

            'name'=>$request->class_name,
            'first_id'=>$request->first_id_value,
            'sort'=>$request->sort,
            'goods_type'=>$request->goods_type

        ]);

        if($res){
            return redirect('commody/class/manage/list');
        }else{
            return back() -> with('errors','数据插入失败');
        }

    }


    //编辑一级分类
    public function comClasManFirEdit($id){


        $data = \DB::table('ys_goods_class')->where('first_id',0)->where('id',$id)->first();

        return view('commonClassFirEdit',['data'=>$data]);

    }

    //处理编辑一级分类信息
    public function comClasManEditFirSave(Request $request)
    {
        //查询是否有需要更新的值
        $is_have = \DB::table('ys_goods_class')->where('id',$request->id)->where('name',$request->class_name)->where('sort',$request->sort)->first();


        if(empty($is_have)){ //如果为空，则表示有不同数据，需要被更新

            $res = \DB::table('ys_goods_class')->where('id',$request->id)->update([
                'name'=>$request->class_name,
                'sort'=>$request->sort,
            ]);

            if($res){
                return redirect('commody/class/manage/list');
            }else{
                return back() -> with('errors','数据更新失败');
            }

        }else{

            return back() -> with('errors','无需要更新的数据');
        }


    }

    //删除一级分类
    public function comClasManFirDel($id){

        \DB::table('ys_goods_class')->where('id',$id)->delete();
        return redirect('commody/class/manage/list');

    }


    //添加二级商品分类
    public function comClasManSecAdd(){


        //一级分类信息
        $first_info = \DB::table('ys_goods_class')->where('first_id',0)->orderBy('sort','asc')->get();

        if(empty($first_info)){//未找到分类信息在ys_goods_class表

            return back() -> with('errors','未找到一级分类信息');
        }

        //关联类型信息
        $type_info = \DB::table('ys_goods_type')->orderBy('sort','asc')->get();

        if(empty($type_info)){//未找到类型信息
            return back() -> with('errors','未找到类型信息');
        }

        return view('commonClassSecAdd',['type_info'=>$type_info,'first_info'=>$first_info]);

    }

    //保存二级商品分类添加信息
    public function comClasManSecSave(Request $request)
    {


            $res = \DB::table('ys_goods_class')->insert([

                'name'=>$request->class_name,
                'first_id'=>$request->first_id_value,
                'sort'=>$request->sort,
                'goods_type'=>$request->goods_type

            ]);

            if($res){
                return redirect('commody/class/manage/list');
            }else{
                return back() -> with('errors','数据插入失败');
            }



    }






}