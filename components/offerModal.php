<style>
  .role {
    display: inline-block;
    width: 150px;
    height: 50px;
    text-align: center;
    border: 1px solid #ddd;
    line-height: 50px;
    cursor: pointer;
    border-radius: 8px;
  }

  .role_input:checked+.role {
    background-color: #717fe0;
    color: #fff;
  }
</style>
<div class="modal fade m-t-120" id="offerModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Offerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalOffer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:225px;">
        <center>
          <div class="wrap-input1 w-full p-b-4 m-t-20" style="width: 50%;">
            <input class="input1 bg-none plh1 stext-107 cl7 m-t-18" type="number" name="price" id="offer" placeholder="Prezzo" />
            <div class="focus-input1 trans-04"></div>
          </div>
          <br>
          <label>Seleziona metodo di pagamento:</label>
          <br>
          <div class="row m-b-30">
            <div class="col-md-6">
              <input type="checkbox" name="venditore" id="card" style="display:none;" class="role_input" />

              <label for="small" class="role" onclick="card()">Carta di credito</label>
            </div>
            <div class="col-md-6">
              <input type="checkbox" name="acquirente" id="person" style="display:none;" class="role_input" />

              <label for="small" class="role" onclick="person()">Persona</label>
            </div>
          </div>
        </center>
      </div>
      <div class="modal-footer">
        <button class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04" onclick="handleOffer()">
          invia
        </button>
      </div>
    </div>
  </div>
</div>