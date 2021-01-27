<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<style>
  @import url(https://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);

  * {
    font-family: roboto;
  }


  div.stars {
    /* width: 225px; */
    display: inline-block;
  }

  input.star {
    display: none;
  }

  label.star {
    float: right;
    padding: 3px;
    font-size: 30px;
    color: #444;
    transition: all .2s;
  }

  input.star:checked~label.star:before {
    content: '\f005';
    color: #FD4;
    transition: all .25s;
  }


  input.star-5:checked~label.star:before {
    color: #FE7;
    text-shadow: 0 0 5px #952;
  }

  input.star-1:checked~label.star:before {
    color: #F62;
  }

  label.star:hover {
    transform: rotate(-15deg) scale(1.3);
  }

  label.star:before {
    content: '\f006';
    font-family: FontAwesome;
  }

  .rev-box {
    overflow: hidden;
    height: 0;
    width: 100%;
    transition: all .25s;
  }


  label.review {
    display: block;
    transition: opacity .25s;
  }

  input.star:checked~.rev-box {
    height: 125px;
    overflow: visible;
  }
</style>

<div class="modal fade m-t-120" id="rateModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <input hidden id="transactionId" />
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:125px;margin-top:20px">
        <div class="row" style="margin-left:-35px">
          <div class="col-md-1"></div>
          <div class="col-md-5" style="margin-right:10px">
            <center>
              <p>Serietà:</p>
            </center>
          </div>
          <div class="col-md-5" style="margin-left:10px">
            <center>
              <p>Puntualità:</p>
            </center>
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row" style="margin-left:-35px">
          <div class="col-md-1"></div>
          <div class="col-md-5" style="margin-right:10px">
            <center>
              <div class="stars">
                <form action="">
                  <input id="serieta" hidden value="0"/>
                  <input class="star star-5" id="star-5" type="radio" name="star" onclick="changeSerieta(5)"/>
                  <label class="star star-5" for="star-5"></label>
                  <input class="star star-4" id="star-4" type="radio" name="star" onclick="changeSerieta(4)"/>
                  <label class="star star-4" for="star-4"></label>
                  <input class="star star-3" id="star-3" type="radio" name="star" onclick="changeSerieta(3)"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" id="star-2" type="radio" name="star" onclick="changeSerieta(2)"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" id="star-1" type="radio" name="star" onclick="changeSerieta(1)"/>
                  <label class="star star-1" for="star-1"></label>
                </form>
              </div>
            </center>
          </div>
          <div class="col-md-5" style="margin-left:10px">
            <center>
              <div class="stars">
                <form action="">
                <input id="puntualita" hidden value="0"/>
                  <input class="star star-5" id="star-5-2" type="radio" name="star" onclick="changePuntualita(5)"/>
                  <label class="star star-5" for="star-5-2"></label>
                  <input class="star star-4" id="star-4-2" type="radio" name="star" onclick="changePuntualita(4)"/>
                  <label class="star star-4" for="star-4-2"></label>
                  <input class="star star-3" id="star-3-2" type="radio" name="star" onclick="changePuntualita(3)"/>
                  <label class="star star-3" for="star-3-2"></label>
                  <input class="star star-2" id="star-2-2" type="radio" name="star" onclick="changePuntualita(2)"/>
                  <label class="star star-2" for="star-2-2"></label>
                  <input class="star star-1" id="star-1-2" type="radio" name="star" onclick="changePuntualita(1)"/>
                  <label class="star star-1" for="star-1-2"></label>
                </form>
              </div>
            </center>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button onclick="eval()" class="flex-c-m stext-101 cl0 bg1 bor1 hov-btn2 trans-04" style="width: 90px;height: 35px;">
          valuta
        </button>
      </div>
    </div>
  </div>
</div>