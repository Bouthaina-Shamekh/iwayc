<?php
$moneyYears = \App\Models\Money_year::leftJoin('year_view', 'year_view.year_id','=','money_years.id')->where('active','1')->where('year_view.user_id','=',Auth::user()->id)->where('isdelete','=','0')->orderBy('year')->get();
{{--
$moneyWork = \App\Models\Money_year::leftJoin('year_view', 'year_view.year_id','=','money_years.id')->where('basic_work','1')->where('year_view.user_id','=',Auth::user()->id)->where('isdelete','=','0')->first(); --}}
$moneyWork = \App\Models\Money_year::where('basic_work','1')->where('isdelete','=','0')->first();
$userL = \App\Models\User_year::where('user_id', Auth::user()->id)->count(); ?>

@if ($userL>0) <?php $userY = \App\Models\User_year::where('user_id', Auth::user()->id)->first();
 $uY = $userY->year; ?>
@else <?php $uY = null; ?> @endif


            	<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
						<h4 class="content-title mb-0 my-auto">@yield('title-page-header')</h4><span class="text-muted mt-1 tx-17 mr-2 mb-0">/ @yield('page-header')</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">

                        <div class="tags pr-1 mb-3 mb-xl-0 ml-3 tg">
                           <span class="tag tag-blue"> <a href="{{ route('CollectionFees.index') }}"> تحصيل الرسوم</a></span>
                            <span class="tag tag-green"><a href="{{ route('Quota.index') }}">جدول الحصص</a></span>
                            <span class="tag tag-indigo"><a href="{{ route("Offer.index") }}">عروض الدورات</a></span>
                            <span class="tag tag-purple"><a href="{{ route("StudentCourse.index") }}">تسجيل دوره</a></span>
                            <span class="tag tag-orange"><a href="{{ route('RepositoryIn.index') }}">قبض مستودع</a></span>
                            <span class="tag tag-red"><a href="{{ route("CatchReceipt.index") }}">قبض دورات</a></span>

                        </div>

						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
                            <?php if(request()->route()->getActionMethod()!= "getYearStudents"){ ?>
						             <select name="money_id" id="money_id" class="form-control">
                                        <option value="0"> اختر السنة...</option>
                                        @foreach($moneyYears as $moneyYear)

                                            @if ($uY == null)
                                                <option {{$moneyWork->year==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>

                                            @else
                                                <option {{$uY==$moneyYear->year?"selected":""}} value="{{$moneyYear->year}}"> {{$moneyYear->year}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                      <?php } ?>
							</div>
						</div>
					</div>
				</div><br>


				<!-- breadcrumb -->
          <div class="row">
        <div class="col-11">
        @yield('button1')
        </div>
        <div class="col-1">
       @yield('button2')
        </div>
        </div><br>




<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
<script>

    $('#money_id').change(function () {

        if ($(this).val() != '0') {
            var id = $('select[name=money_id]').val();
            $.ajax({
                url: "/CMS/yearOfUser/" + id,
                success: function (data) {
                    if (data.status == 1) {
                        $('#pMoney').replaceWith('<span id="pMoney">' + data.year + '</span>');
                        alert('تمت تغير عام العمل بنجاح');
                    }
                    else {alert('حدث خطأ اثناء تنفيذ العملية');}
                }
            })
        }
    });
</script>

