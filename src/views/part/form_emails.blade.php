<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>

    @if(isset($info->id))
        <h4 class="modal-title" id="modal_form_label">{{__cms('Редактирование')}}</h4>
    @else
        <h4 class="modal-title" id="modal_form_label">{{__cms('Создание')}}</h4>
    @endif
</div>
<div class="modal-body">

    <form id="form_page" class="smart-form" enctype="multipart/form-data" method="post" novalidate="novalidate" >
      <fieldset style="padding:0">
        <div class="row">
              <section class="col col-6">
                <label class="label" for="title">{{__cms('Название')}}</label>
                <div style="position: relative;">
                  <label class="input">
                  <input type="text" id="title" value="{{{ $info->title or "" }}}" name="title"
                    class="dblclick-edit-input form-control input-sm unselectable">
                  </input>
                  </label>
                </div>
              </section>
              <section class="col col-6">
                <label class="label" for="slug">{{__cms('Код')}}</label>
                <div style="position: relative;">
                  <label class="input">
                  <input type="text" id="slug" value="{{ $info->slug or "" }}"  name="slug"
                     {{ isset($info->slug)?"readonly":"" }}
                    class="dblclick-edit-input form-control input-sm unselectable">
                  </input>
                  </label>
                </div>
              </section>
       </div>
        <div class="row">
            <section class="col col-12" style="float: none">
             <label class="label">{{__cms('Тема письма')}}</label>
             <div style="position: relative;">
                 <label class="input">
                  <input type="text" value="{{{ $info->subject or "" }}}" name="subject"  class="dblclick-edit-input form-control input-sm unselectable"></input>
                 </label>
              </div>
            </section>
        </div>
       <div class="row">
            <section class="col" style="float: none">
                 <label class="label">{{__cms('Тело письма')}}</label>
                 <textarea name="body" class="text_block">{{$info->body or ""}}</textarea>
            </section>
        </div>
      </fieldset>
        <div class="modal-footer">
          <i class="fa fa-gear fa-41x fa-spin" style="display: none"></i>
          <button  type="submit" class="btn btn-success btn-sm"> <span class="glyphicon glyphicon-floppy-disk"></span> {{__cms('Сохранить')}} </button>
          <button type="button" class="btn btn-default" data-dismiss="modal"> {{__cms('Отмена')}} </button>
        </div>

        <input type="hidden" name="id" value="{{$info->id or "0"}}">
    </form>
</div>
 <script>
    @if(!isset($info->id))
         $("#form_page [name=title]").keyup(function(){
             $("#form_page [name=slug]").val(slug_gen($("#form_page [name=title]").val()));
         })
    @endif;
 </script>
