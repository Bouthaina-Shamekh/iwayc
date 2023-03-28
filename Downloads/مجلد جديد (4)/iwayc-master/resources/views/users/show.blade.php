
@extends('layouts.master')
@section('css')

@section('title')
Iwayc System

@endsection

@section('title-page-header')
المستخدمين

@endsection
@section('page-header')
عرض مستخدم

@endsection
@section('button1')

@endsection
@section('button2')
<a class="btn btn-primary btn-md" href="{{ route('users.index') }}">رجوع</a>
@stop
@endsection

@section('content')
@can('عرض مستخدم')



<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
            <div class="">
    <div class="row mg-b-20 text-center">
  <div class="col">
         <img src="{{URL::asset('storage/users-avatar/'.$user->avatar)}}" style="width:150px;height:150px;border-radius:50%;" id="getUserAvatar">
        </div>
          </div><br>

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"autocomplete="false"readonly onfocus="this.removeAttribute('readonly');"
                                    data-parsley-class-handler="#lnWrapper" value="{{ $user->name }}"disabled type="text">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" value="{{ $user->email }}"disabled type="email">
                            </div>
                        </div>

                              <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label> المستخدم المسؤول: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"autocomplete="false"readonly onfocus="this.removeAttribute('readonly');"
                                    data-parsley-class-handler="#lnWrapper" value="{{\App\Models\User::find($user->responsible_id )->name ?? ''}}"disabled type="text">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>الفاعليه: <span class="tx-danger">*</span></label>

                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" value="{{ $user->Status }}"disabled type="email">
                            </div>
                        </div>


    <div class="row">

        <div class="col">
            <label class="control-label">Roles:</label><br>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
        </div>
    </div>



        </div>
    </div>
</div>

</div>
@endcan
@cannot('عرض مستخدم')
<div class="col-md-offset-1 col-md-10 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    ليس لديك صلاحية يرجي مراجعة المسؤول
</div>
@endcannot

<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

@endsection
