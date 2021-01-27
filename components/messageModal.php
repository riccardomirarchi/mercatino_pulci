<div class="modal fade m-t-120" id="messageModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Messaggio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:200px;">
        <center>
          <div class="wrap-input1 w-full p-b-4 m-t-20" style="width: 80%;">
            <textarea 
            class="input1 bg-none plh1 stext-107 cl7 m-t-18" 
            type="text" name="message" id="message" 
            placeholder="Messaggio..." 
            style="height:125px;color:#333;">Ciao <?php echo $result['nome']?> ti contatto per l'annuncio <?php  echo $result['titolo']?>,</textarea>
            <div class="focus-input1 trans-04"></div>
          </div>
          <br>
        </center>
      </div>
      <div class="modal-footer">
        <button class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04" onclick="handleMessage()">
          invia messaggio
        </button>
      </div>
    </div>
  </div>
</div>