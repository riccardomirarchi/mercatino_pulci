<div class="modal fade m-t-120" id="deleteAd" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminazione Annuncio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Sei sicuro di voler procedere con l'eliminazione?</h5>
      </div>
      <div class="modal-footer">
      <input hidden id="product" />
        <button class="flex-c-m stext-101 cl0 size-126 bg1 bor1 m-l-25" onclick="handleDelete()" style="background-color:red; color: white;">
          Elimina
        </button>
      </div>
    </div>
  </div>
</div>