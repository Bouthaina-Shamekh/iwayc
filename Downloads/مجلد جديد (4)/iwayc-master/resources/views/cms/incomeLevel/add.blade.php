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

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('IncomeLevel.index') }}">رجوع</a>
@stop
@endsection
@section('content')

   <?php $userL = \App\Models\User_year::where('user_id',Auth::user()->id)->count(); ?>
    @if ($userL>0)
        <?php
        $userY = \App\Models\User_year::where('user_id',Auth::user()->id)->first();
        $uY = $userY->year;
        ?>
    @else
        <?php $uY = null; ?>
    @endif

<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                    <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/IncomeLevel">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="col control-label">اسم مستوى الدخل:* </label>

                                <div class="col">
                                    <input type="text" value="{{old('name')}}" class="form-control validate[required] text-input" id="name"
                                           name="name" placeholder="ادخل مستوى الدخل">
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                </div>
                                </div>

                                 <div class="col">
                                    <label class="col control-label">الفترة من:* </label>

                                    <div class="col">
                                        <input type="text" value="" class="form-control fc-datepicker" id="in_from"
                                               name="in_from">
                                        <div class="text-danger">{{$errors->first('in_from')}}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="col control-label"> الفترة الى:* </label>

                                    <div class="col">
                                        <input type="text" value="" class="form-control fc-datepicker" id="in_to"
                                               name="in_to">
                                        <div class="text-danger">{{$errors->first('in_to')}}</div>
                                    </div>
                                    </div>

                        </div><br>

                        <div class="row">
                       <div class="col">
                        <label class="col control-label">المصاريف المتوقعة:* </label>

                        <div class="col">
                            <input type="number" min="0" value="{{old('expenses')}}" class="form-control validate[required] text-input" id="expenses"
                                   name="expenses" placeholder="ادخل المصاريف المتوقعة">
                            <div class="text-danger">{{$errors->first('expenses')}}</div>
                        </div>
                         </div>

                        </div><br>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                <label class="control-label">الصناديق المشتركة:* </label>

                                    <select id="select-state" name="in_boxes[]"multiple class="form-control form-control-lg select2" size="1"  placeholder="اختر الصناديق المشتركة...">
                                        <option value="">اختر الصناديق المشتركة  ...</option>
                                        @foreach($boxes as $box)
                                            <option {{(collect(old('in_boxes'))->contains($box->id)) ? 'selected':''}} value="{{$box->id}}"> {{$box->name}} </option>
                                        @endforeach
                                    </select>
                                    <span class="help_text">يرجى اختيار الصناديق المشتركة كحد أقصى 10 صناديق</span>
                                    <div class="text-danger">{{$errors->first('in_boxes')}}</div>
                                </div>
                                </div>



                        <div class="col">
                            <label class="col control-label">المستوى 1: </label>

                            <div class="col">
                                <input type="number" min="0" value="{{old("level1")}}" class="form-control text-input" id="level1"
                                       name="level1" placeholder="أدخل المستوى 1">
                            </div>
                                </div>

                        </div><br>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col control-label">المستوى 2: </label>

                                    <div class="col">
                                        <input type="number" min="0" value="{{old("level2")}}" class="form-control text-input" id="level2"
                                               name="level2" placeholder="أدخل المستوى 2">
                                    </div>
                                </div>
                                </div>
                            <div class="col">
                                <label class="col control-label">المستوى 3: </label>

                                <div class="col">
                                    <input type="number" min="0" value="{{old("level3")}}" class="form-control text-input" id="level3"
                                           name="level3" placeholder="أدخل المستوى 3">
                                </div>

                                </div>
                         <div class="col">
                            <label class="col control-label">المستوى 4: </label>

                            <div class="col">
                                <input type="number" min="0" value="{{old("level4")}}" class="form-control text-input" id="level4"
                                       name="level4" placeholder="أدخل المستوى 4">
                            </div>

                         </div>

                         <div class="col">
                            <label class="col control-label">المستوى 5: </label>

                                <div class="col">
                                    <input type="number" min="0" value="{{old("level5")}}" class="form-control text-input" id="level5"
                                           name="level5" placeholder="أدخل المستوى 5">
                                </div>

                         </div>

                        </div><br>








                           <div class="row ls_divider">
                           <div class="col-1">

                            </div>
                            <div class="col">
                                <label for="inputName" class="h4">فعال :</label>
                                    <input type="checkbox"value="1"   class="largerCheckbox" id="active" name="active"
                               {{old("active")?"checked":""}}>
                            </div>
                        </div>

                        <div class="row last">
                            <div class="col">
                                <label class="control-label"></label>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                    <a href="/CMS/IncomeLevel/" class="btn btn-danger"> إلغاء</a>
                                </div>
                            </div>
                        </div>

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
