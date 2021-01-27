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
<div class="modal fade m-t-120" id="exampleModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cambia Ruolo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action='api/profile_synchronous_functions.php?changeUserRole=1' method='POST'>
        <div class="modal-body">
          <center style="margin-bottom:-15px;">
            <label>Seleziona la/le tipologia/e di account:</label><br>
            <div class="row m-b-30 m-t-10">
              <div class="col-md-6">
                <input type="checkbox" name="venditore" id="venditore" style="display:none;" class="role_input" />

                <label for="small" class="role" onclick="seller()">Venditore</label>
              </div>
              <div class="col-md-6">
                <input type="checkbox" name="acquirente" id="acquirente" style="display:none;" class="role_input" />

                <label for="small" class="role" onclick="buyer()">Acquirente</label>
              </div>
            </div>
            <p class="m-b-20" style="color:red;">
              <?php if (isset($_REQUEST["selectionError"])) {
                echo 'Specifica un ruolo!';
              } ?></p>
          </center>
        </div>
        <div class="modal-footer">
          <button class="flex-c-m stext-101 cl0 size-126 bg1 bor1 hov-btn4 p-lr-15 trans-04">
            Cambia
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// session_start();
if (isset($_SESSION['ruolo'])) {
  $role = $_SESSION['ruolo'];
}
?>
<script>
  if ("<?php echo $role ?? '' ?>" == 'e') {
    document.getElementById("venditore").checked = true;
    document.getElementById("acquirente").checked = true;
  } else if ("<?php echo $role ?? '' ?>" == 'a') {
    document.getElementById("acquirente").checked = true;
  } else if ("<?php echo $role ?? '' ?>" == 'v') {
    document.getElementById("venditore").checked = true;
  }
</script>