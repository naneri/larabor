<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title"><i class=" icon-mail-2"></i> Написать владельцу </h4>
    </div>
    <form action="{{route('item.contact-owner')}}" method="POST" role="form">
      <div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="item_id" value="{{$item->pk_i_id}}">
        <div class="form-group">
          <label for="recipient-Phone-Number"  class="control-label">Номер Телефона <span class="text-muted">(необязательно)</span>:</label>
          <input type="text" name="phone" maxlength="60" class="form-control" id="recipient-Phone-Number">
        </div>
        <div class="form-group">
          <label for="message-text" class="control-label">Сообщение:</label>
          <textarea class="form-control" id="message-text" rows="5" data-placement="top" name="text" data-trigger="manual"></textarea>
        </div>
        <div class="form-group">
          <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-success pull-right">Отправить!</button>
      </div>
    </form>
  </div>
</div>