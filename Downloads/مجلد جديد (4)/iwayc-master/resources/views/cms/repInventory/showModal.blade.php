
@section('css')

@endsection

    <div class="row">
        <div class="col-md-12 col-md-offset-1">

            <div class="panel panel-default">
                   <div class="panel-heading">
                    <h3 class="panel-title"> <strong style="color:#d43f3a;font-size: 18px;">{{\App\Models\Material::find($rep->material_id)->name}}</strong></h3>
                </div>
                <div class="panel-body form_view">
                   <form id="formID" class="formular form-horizontal ls_form" method="post" action="/CMS/add/RepInventory/{{$id}}">
                              @csrf
                        <div class="row">
                            <div class="col text-center">
                           <label class="control-label"style="font-size:20px">عدد الجرد الموجود </label>
                                <input type="number" min="0" name="count_inv"id="count_inv" value="{{ $rep->count_inv }}"class="form-control validate[required]">
                                <div class="text-danger">{{$errors->first('count_inv')}}</div>
                                <input type="hidden" value="{{$rep->last_price}}"id="last_price" name="last_price">
                                <input type="hidden" value="{{$rep->count}}"id="count"name="count">
                                <input type="hidden" min="0" name="remaind_h" id="remaind" value="">
                                <input type="hidden" min="0" name="rem_price_h" id="rem_price" value="">
                            </div>

                        </div><br>

                         <div class="row">
                            <div class="col text-center">
                                <label class="control-label"></label>
                                <button class="submit btn-primary btn" type="submit" name="submit">حفظ</button>
                                <a href="/CMS/Rep/Inventory/{{$rep->repository_id}}" class="btn btn-danger"> إلغاء</a>
                                </div>

                    </form>

                </div>
            </div>
        </div>
    </div>




  <script>
    function fSum() {
            var count_inv = parseFloat($("#count_inv").val());
            var count = parseFloat($("#count").val());
            var last_price = parseFloat($("#last_price").val());
            var remaind = count - count_inv;
            var rem_price = remaind * last_price;
            $("#remaind").val(remaind);
            $("#remaind_h").val(remaind);
            $("#rem_price_h").val(rem_price);
            $("#rem_price").val(rem_price);
            console.log(last_price);
        }
        window.onload = function() {
            fSum();

        };
        $('#count_inv').change(function() {
            fSum();
        });

    </script>


