
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
.note-popover{
    display:none !important;
}
.note-toolbar {
       display:none !important;
}
</style>

                              <div class="row">
                              <div class="col-3">
                                <div class="ls-timeline-user">
                                <div class="media">
                            @if (\App\Models\User::Find($item->sender) !== null )
                                    <a class="pull-left" href="#">
                                         <img class="media-object brround"style="width:75px;height:75px;"  src="{{asset('storage\users-avatar/'.\App\Models\User::find($item->sender)->avatar)}}" alt="user">
                                    </a>

                            </div><br>
                                    <div class="">
                                        <h4 class="">{{\App\Models\User::find($item->sender)->name}}</h4>
                             @endif
                                        <time class="ls_tmtime" datetime="{{$item->created_at}}">
                                            <span>{{$item->created_at->format('Y-m-d')}}</span> <span>{{$item->created_at->format('h:i')}}</span>
                                        </time>
                                    </div>


                            </div>
                              </div>

                      {{--       <div class="col">
								<div class="popover bs-popover-left">
								<div class="arrow"></div>
								<h3 class="popover-header">{{$item->title}}</h3>
								<div class="popover-body">
								<p>{!! $item->details !!}</p>
								</div>
							    </div><!-- popover -->
							</div><!-- col-6 --> --}}


                            <div class="col">

                                       <textarea  class="animatedTextArea form-control summernote" id="summernote" name="details"disabled>{!! $item->details !!}</textarea>


                            </div>


                          </div>

             {{--            </li>

                    </ul>
                </div>
            </div>
        </div> --}}




 <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400,

    });
     $('#summernote').next().find(".note-editable").attr("contenteditable", false);
</script>
 
