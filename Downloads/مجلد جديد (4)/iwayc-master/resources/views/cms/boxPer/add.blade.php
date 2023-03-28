@extends('layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
<a class="btn btn-primary btn-md" href="/CMS/BoxPer">رجوع</a>
@stop
@endsection
@section('content')


<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">


        <div class="card">
            <div class="card-body">
                        <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/BoxPer/{{$id}}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="control-label"> يظهر لـ:*  </label>

                                        @if(count($boxPers)>0)
                                            @foreach($boxPers as $boxPer)
                                                <span disabled class="teg tag-orange"style="font-size:15px">
                                                  {{ \App\Models\User::find($boxPer->user_id)->name }}  </span>
                                            @endforeach
                                        @else
                                            <span disabled class="btn btn-danger">لم يتم اضافة اي مستخدم لعرض الصندوق</span>
                                        @endif
                                        <br><br>
                                        <select name="user_show[]" id="select-state" multiple class="form-control form-control-lg select2">
                                            <option value=""> اختر من القائمة.... </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}"> {{$user->name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger">{{$errors->first('user_show')}}</div>
                                    </div>
                                </div>
                            </div><br>

                            <div class="row">
                                <div class="col text-center">
                                    <label class="control-label"></label>
                                    <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                        <a href="/CMS/BoxPer/" class="btn btn-danger"> إلغاء</a>

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

<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>



@endsection
