@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@section('title')
Iwayc System

@endsection

@section('title-page-header')
{{ $title }}

@endsection
@section('page-header')
{{ $parentTitle }}

@endsection
@section('button1')
<a class="btn btn-primary btn-md" href="{{ route('IncomeLevel.create') }}"><i class='fas fa-plus'style="margin-left: 10px"></i>اضافه مستوي دخل جديد</a>
@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('IncomeLevel.index') }}">رجوع</a>
@stop
@endsection
@section('content')


<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">


        <div class="card">
        <div class="card-body">
    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/IncomeLevel/{{$item->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="row">
                            <div class="col">
                                <label class="control-label">اسم مستوى الدخل:* </label>
                                    <input type="text" value="{{$item->name}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="ادخل مستوى الدخل">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                                 <div class="col">
                                <label class="control-label">الفترة من:* </label>
                                    <input type="text" value="{{$item->in_from}}" class="form-control fc-datepicker" id="in_from"
                                           name="in_from">
                                    <div class="text-danger">{{$errors->first('in_from')}}</div>
                                </div>
                               <div class="col">
                                <label class="control-label">الفترة الي:* </label>
                                    <input type="text" value="{{$item->in_to}}" class="form-control fc-datepicker" id="in_to"
                                           name="in_to">
                                    <div class="text-danger">{{$errors->first('in_to')}}</div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المصاريف المتوقعة:* </label>
                                    <input type="number" min="0" value="{{$item->expenses}}" class="form-control validate[required] text-input" id="expenses"
                                           name="expenses" placeholder="ادخل المصاريف المتوقعة">
                                    <div class="text-danger">{{$errors->first('expenses')}}</div>
                                </div>

                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label class="control-label">الصناديق المشتركة:* </label>
                                    @if(count($in_boxes)>0)
                                        @foreach($in_boxes as $in_box)
                                        <?php $bb=\App\Models\Box::find($in_box->box_id);
                                        if($bb){
                                        ?>
                                            <span disabled class="btn btn-info"> {{$bb->name}} </span>
                                            <?php }?>
                                        @endforeach
                                    @else
                                        <span disabled class="btn btn-danger">لم يتم اضافة اي صندوق</span>
                                    @endif
                                    <br><br>
                                    <div class="col">
                                    <select id="select-state" name="in_boxes[]" multiple class="form-control form-control-lg select2" placeholder="اختر الصناديق المشتركة...">
                                        <option value="">اختر المهارات المطلوبة...</option>
                                        @foreach($boxes as $box)
                                                <option value="{{$box->id}}"> {{$box->name}} </option>
                                        @endforeach
                                    </select><br>
                                    <span class="text-danger">يرجي اختيار الصناديق المشتركة كحد اقصي 10 مهارات</span>
                                    <div class="text-danger">{{$errors->first('in_boxes')}}</div>
                                </div>
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستوي 1: </label>
                                    <input type="number" min="0" value="{{$item->level1}}" class="form-control text-input" id="level1"
                                           name="level1" placeholder="أدخل المستوى 1">
                                </div>
                         <div class="col">
                                <label class="control-label">المستوي 2: </label>
                                    <input type="number" min="0" value="{{$item->level2}}" class="form-control text-input" id="level2"
                                           name="level2" placeholder="أدخل المستوى 2">
                                </div>
                           <div class="col">
                                <label class="control-label">المستوي 3: </label>
                                    <input type="number" min="0" value="{{$item->level3}}" class="form-control text-input" id="level3"
                                           name="level3" placeholder="أدخل المستوى 3">
                                </div>
                            </div><br>

                        <div class="row">
                            <div class="col">
                                <label class="control-label">المستوي 4: </label>
                                    <input type="number" min="0" value="{{$item->level4}}" class="form-control text-input" id="level4"
                                           name="level4" placeholder="أدخل المستوى 4">
                                </div>
                         <div class="col">
                                <label class="control-label">المستوي 5: </label>
                                    <input type="number" min="0" value="{{$item->level5}}" class="form-control text-input" id="level5"
                                           name="level5" placeholder="أدخل المستوى 5">
                                </div>
                            </div><br>
                           <div class="row ">
                               <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"{{$item->active?"checked":""}}>
                            </div>
                        </div><br>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>
                                <div class="col-sm-10 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/IncomeLevel/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div><br>

                    </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>

<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endsection
