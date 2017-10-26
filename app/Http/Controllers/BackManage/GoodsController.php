<?php

namespace App\Http\Controllers\BackManage;

use App\GoodsModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
    //商品列表
    public function Goodslist(Request $request)
    {
    	$search=[];
        $data = GoodsModel::orderBy('sort','asc')
            ->orderBy('created_at','desc');
        if($request->name !=''){
            $data->where('name','like','%'.$request->name.'%');
            $search['name']=$request->name;
        }
        if ($request->state != ''){
            $data->where('state',$request->state);
            $search['state']=$request->state;
        }
        $paginate = $data->paginate(10);
        return view('goods.goodslist',['data'=>$paginate,'search'=>$search]);
    }
    //添加
    public function Goodsadd()
    {    	
    	//所有供应商
    	$suppliers=\App\SupplierModel::where('state',1)->get();    	
        return view('goods.goodsadd',['suppliers'=>$suppliers]);
    }
    //提交商品
    public function Store(Request $request)
    {
    	$image=[];
    	foreach ($request->file('image') as $file){
    		$up_res=uploadPic($file);
    		$file_name[]=$up_res;
    		$image = $file_name['0'];
    	}
    	
    	dd($image);

        $input = Input::except('_token');
        $rules = [
            'name'=> 'required',
            'num'=> 'required|regex:/^[0-9]{1,9}$/',
            'price'=> 'required',
            'cost_price'=> 'required',
            'content'=> 'required',
            'sort'=> 'required',
            'supplier_id'=> 'required',
            
        ];
        $massage = [
            'name.required' =>'商品名称不能为空',
            'num.required' =>'商品库存不能为空',
            'num.regex' =>'商品库存必须大于0，且长度小于9位',
            'price.required' =>'销售价不能为空',
            'cost_price.required' =>'成本价不能为空',
            'content.required' =>'商品详情不能为空',
            'sort.required' =>'商品排序不能为空',
            'supplier_id.required' =>'供应商不能为空',
        ];
        $validator = \Validator::make($input,$rules,$massage);

        if($validator->passes()){/**/
        	if ($request->hasFile('image')){//图片上传
        		$image=[];
        		foreach ($request->file('image') as $file){
        			$up_res=uploadPic($file);
        			$file_name[]=$up_res;
        			$image = $file_name['0'];
        		}
        	}
        	
            $params=array(
                'name'=>$request->name,
                'num'=>$request->num,
                'price'=>$request->price,
            	'cost_price'=>$request->cost_price,
                'content'=>$request->content,
                'sort'=>$request->sort,
                'state'=>$request->state>0?$request->state:0,
                'supplier_id'=>$request->supplier_id,
            );
            $res = GoodsModel::create($params);
            if($res){
                return redirect('goodslist');
            }else{
                return back() -> with('errors','数据填充失败');
            }
        }else{
            return back() -> withErrors($validator);
        }

    }
    //编辑商品
    public function Edit($id)
    {
        $data = GoodsModel::where('id',$id)->first();
        return view('goods.goodsadd',['data'=>$data]);
    }

    //编辑商品保存
    public function Goodssave(Request $request)
    {
        $input = Input::except('_token');
        $input['url'] = '';
        if ($request->image == '' && $request->image_url == ''){
            $input['url'] = '';
        }elseif ($request->image != ''){
            $input['url'] = $request->image ;
        }elseif ($request->image_url != ''){
            $input['url'] = $request->image_url ;
        }
        //dd($input);
        $rules = [
            'name'=> 'required',
            'num'=> 'required|regex:/^[0-9]{1,9}$/',
            'price'=> 'required',
            'price_grade1'=> 'required',
            'price_grade2'=> 'required',
            'price_grade3'=> 'required',
            'price_grade4'=> 'required',
            'editorValue'=> 'required',
            'sort'=> 'required',
            'url'=> 'required',


        ];
        $massage = [
            'name.required' =>'商品名称不能为空',
            'num.required' =>'商品库存不能为空',
            'num.regex' =>'商品库存必须大于0，且长度小于9位',
            'price.required' =>'普通会员价不能为空',
            'price_grade1.required' =>'红卡会员价不能为空',
            'price_grade2.required' =>'金卡会员价不能为空',
            'price_grade3.required' =>'白金卡会员价不能为空',
            'price_grade4.required' =>'黑卡会员价不能为空',
            'editorValue.required' =>'商品详情不能为空',
            'sort.required' =>'商品排序不能为空',
            'url.required' =>' 商品图片不能为空',
        ];
        $validator = \Validator::make($input,$rules,$massage);
        if($validator->passes()){
            if ($request->hasFile('image')){//图片上传
                $up_res=uploadPic($request->file('image'));
                $file_name[]=$up_res;
                $image = $file_name['0'];
            }else{

                if ($input['image_url'] == ''){
                    $image = '';
                }else{
                    $image_url =  explode("=",$input['image_url']);
                    $image = $image_url['1'];
                }

            }
            $input['image'] = $image;

            $id = $input['id'];
            if ($request->state == ''){
                $state = 1;
            }else{
                $state = $request->state;
            }
            $params=array(
                'name'=>$input['name'],
                'num'=>$input['num'],
                'content'=>$input['editorValue'],
                'sort'=>$input['sort'],
                'price'=>$input['price'],
                'price_grade1'=>$input['price_grade1'],
                'price_grade2'=>$input['price_grade2'],
                'price_grade3'=>$input['price_grade3'],
                'price_grade4'=>$input['price_grade4'],
                'state'=>$state,
                'image'=>$image,
            );
            $res = GoodsModel::where('id',$id)->update($params);
            if($res === false){
                return back() -> with('errors','数据更新失败');
            }else{
                return redirect('goodslist');
            }
        }else{
            return back() -> withErrors($validator);
        }
    }
    //删除商品
    public function Goodsdel($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('goodslist');
    }
}
