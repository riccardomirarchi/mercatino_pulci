<!DOCTYPE html>
<html lang="it">

<head>
  <title>Messaggi</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php
  require_once 'components/imports.php';
  require_once 'components/header.php';
  require_once 'components/messagesStyle.php';
  ?>
</head>

<body class="animsition" id="body">
  <?php
  require_once 'components/sidebar.php';
  require_once 'api/ads_functions.php';
  require_once 'api/profile_functions.php';
  ?>

  <section class="bg0 p-t-10 p-b-100 m-t-125">
    <div class="container">
      <div class="p-b-10 m-b-60">
        <h3 class="ltext-103 cl5">Messaggi</h3>
      </div>
      <div class="row rounded-lg overflow-hidden shadow p-lr-30">
        <!-- Users box-->
        <div class="col-5 px-0 border">
          <div class="bg-white">

            <div class="bg-gray px-4 py-2 bg-light">
              <p class="h5 mb-0 py-1">Messaggi</p>
            </div>

            <div class="messages-box">
              <div class="list-group rounded-0">


                <?php
                $months = array("Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic");
                $contacts = getMessagesContacts($conn, $userId);

                if ($contacts->num_rows > 0) {
                  while ($contact = $contacts->fetch_assoc()) {

                    $sender = getProfile($conn, $contact['mittente']);

                    $ad = getAdInfo($conn, $contact['annuncio']);

                    $lastMessage = getLastMessage($conn, $sender['id_utente'], $userId, $ad['id_annuncio']);

                    if ($ad['immagine']) {
                      $path = $ad['immagine'];
                    } else {
                      $path = 'na.png';
                    }

                    if ($sender['nome'] != '-') {
                      $nome = $sender['nome'];
                    } else {
                      $nome = 'Anonimo';
                    }

                    $date = explode("-", str_split($lastMessage['data_invio'], 10)[0]);

                    $index = str_replace("0", "", $date[1]);

                    $yourOne = $lastMessage['mittente'] == $userId ? "Tu: " : "";

                    $senderPath = strval($sender['percorso_immagine']);

                    echo '<a class="list-group-item list-group-item-action rounded-0 border-right-0 border-left-0 contactbox" onclick="openChat(this,' . $contact['mittente'] . ',' . $ad['id_annuncio'] . ',' . $userId . ')"> 
                    <div class="media"><img src="ads_images/' . $path . '" alt="user" width="50" height="50" style="object-fit:cover" class="rounded-circle">
                      <div class="media-body ml-4">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                          <h6 class="mb-0">' . substr($nome . ' - ' . $ad['titolo'], 0, 40) . '...</h6><small class="small font-weight-bold">' . $date[2] . ' ' . $months[$index - 1] . '</small>
                        </div>
                        <p style="width:87%" class="font-italic mb-0 text-small m-t-10" id="' . $contact['mittente'] . '-' . $ad['id_annuncio'] . '-' . $userId . '"><span style="font-weight: 900; font-style: normal;">' . $yourOne . '</span>' . $lastMessage['testo'] . '</p>';

                    if (!$lastMessage['visualizzato'] && !$yourOne) {
                      echo '<div style="height:10px;width:10px;border-radius:5px; background-color:#717fe0;position:absolute;right:19px; top:55%" id="' . $contact['mittente'] . '-' . $ad['id_annuncio'] . '-' . $userId . '-seen' . '"></div>';
                    }

                    echo '</div>
                    </div>
                  </a>';
                  }
                } else {
                  echo '<div class="row m-t-50">				
                    <div class="col-md-12 p-r-30" style="height:80px;overflow:hidden; text-align:center">
                      <label>Non hai ricevuto messaggi...</label>
                    </div>
                  </div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Chat Box-->
        <div class="col-7 px-0 border" id="scroll">
          <div class="px-4 py-5 chat-box bg-white" id="chatbox">
            <div style="margin:auto;text-align:center;margin-top:10%">
              <img src="images/icons/chat.png" alt="chat" width="150" height="150" style="object-fit:cover">
              <p class="m-t-30">Seleziona una conversazione</p>
            </div>
          </div>

          <!-- Typing area -->
          <div class="input-group g-light border border-right-0 border-left-0 border-bottom-0" hidden id="boxfield">
            <input type="text" placeholder="Scrivi messaggio..." aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" style="height:2px" id="textinput">
            <div class="input-group-append">
              <button id="button-addon2" type="submit" class="btn btn-link m-t-5 m-r-3 p-l-15" onclick="sendMessage(this)"> <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  require_once 'components/footer.php';
  require_once 'components/scripts.php';
  require_once 'components/changeRoleModal.php';
  require_once 'components/deleteUserModal.php';
  ?>

  <script>
    document.addEventListener('keydown', (e) => {
      if (13 == e.keyCode) {
        if (document.getElementById('boxfield').getAttribute('hidden') != false) {
          sendMessage(document.getElementById("button-addon2"))
        }
      }
    })

    const months = ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic"];

    // scroll automatically to the bottom of the chat
    const scrollToBottom = () => {
      var div = document.getElementById("chatbox")
      div.scrollTop = div.scrollHeight - div.clientHeight;
    }

    const seeMessages = (sender, ad, recipient) => {
      $.ajax({
        type: 'POST',
        url: 'api/profile_ajax_calls.php',
        data: {
          updateMessages: true,
          mittente: sender,
          adId: ad,
        },
        success: (response) => {
          console.log(response);
          // updating header messages counter
          if (response.messagesUpdate?.affected_rows && document.getElementById('messagesHeader').getAttribute("data-label1") > 0) {
            document.getElementById('messagesHeader').setAttribute("data-label1", parseInt(document.getElementById('messagesHeader').getAttribute("data-label1")) - response.messagesUpdate.affected_rows);
            if (document.getElementById('messagesHeader').getAttribute("data-label1") == 0) {
              document.getElementById('messagesHeader').classList.remove('label1')
            }
          }
        },
        error: ({
          responseJSON
        }) => {
          console.log(responseJSON);
        }
      });
    }

    const setLastMessage = (message, sender, ad, recipient, yourOne) => {
      var element = document.getElementById(sender.toString() + '-' + ad.toString() + '-' + recipient.toString())

      var you = yourOne ? "Tu: " : "";
      var html = '<span style="font-weight: 900; font-style: normal;">' + you + '</span>' + message;

      element.innerHTML = html;
    }

    // making a promise, so the callback will be different based on the first or subsequent fetches
    const getMessages = (sender, ad, recipient) => {
      return new Promise((resolve, reject) => {
        $.ajax({
          type: 'POST',
          url: 'api/profile_ajax_calls.php',
          data: {
            getMessages: true,
            mittente: sender,
            adId: ad,
          },
          success: (response) => {
            var chatbox = document.getElementById('chatbox');
            chatbox.innerHTML = '';

            for (i = 0; i < response.length; i++) {
              var path = response[i].immagine && response[i].immagine != '-' ? response[i].immagine : 'avatar.png';
              var time = response[i].data_invio.split(" ")[1].split(":");
              var date = response[i].data_invio.split(" ")[0].split("-");
              var seen = Boolean(parseInt(response[i].visualizzato)) ? 'Visualizzato' : '';
              var html =
                parseInt(response[i].destinatario) == parseInt(recipient) ?
                '<div class="media w-50 mb-3"><img src="profile_images/' + path + '" alt="user" width="50" height="50" style="object-fit:cover" class="rounded-circle"><div class="media-body ml-3"><div class="bg-light rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-muted">' + response[i].testo + '</p></div><p class="small text-muted">' + time[0] + ':' + time[1] + ' | ' + date[2] + ' ' + months[date[1] - 1] + '</p></div></div>' :
                '<div class="media w-50 ml-auto mb-3"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white">' + response[i].testo + '</p></div><p class="small text-muted">' + time[0] + ':' + time[1] + ' | ' + date[2] + ' ' + months[date[1] - 1] + '<span class="small text-muted" style="float:right">' + seen + '</span></p></div></div>';

              chatbox.insertAdjacentHTML('beforeend', html)
            }

            resolve(response)
          },
          error: ({
            responseJSON
          }) => {
            reject(responseJSON)
          }
        });
      })
    }

    var interval = false;
    var num_rows = 0;

    const openChat = (btn, sender, ad, recipient) => {
      if (document.getElementById(sender.toString() + '-' + ad.toString() + '-' + recipient.toString() + '-seen')) {
        document.getElementById(sender.toString() + '-' + ad.toString() + '-' + recipient.toString() + '-seen').setAttribute('hidden', true);
      }

      var contacts = document.getElementsByClassName('contactbox')

      for (i = 0; i < contacts.length; i++) {
        contacts[i].classList.remove('active')
        contacts[i].classList.remove('text-white')
        contacts[i].classList.remove('list-group-item-action')
        contacts[i].classList.add('list-group-item-light')
      }

      btn.classList.add('active')
      btn.classList.add('text-white')
      btn.classList.add('list-group-item-action')
      btn.classList.remove('list-group-item-light')

      clearInterval(interval)

      // adding a polling interval to make the chat a little bit more real-time
      // todo: add a polling interval even for contacts and not only for open chats :)
      interval = setInterval(() => {
        getMessages(sender, ad, recipient).then((data) => {
          if (data.length != num_rows) {
            console.log(data)
            scrollToBottom();
            num_rows = data.length;
            seeMessages(sender, ad, recipient)
            setLastMessage(data[data.length - 1].testo, sender, ad, recipient, data[data.length - 1].mittente == "<?php echo $userId ?>")
          }
        }).catch((err) => {
          console.log(err)
        })
      }, 5000)

      document.getElementById('boxfield').removeAttribute('hidden');
      document.getElementById('button-addon2').setAttribute("sender", sender)
      document.getElementById('button-addon2').setAttribute("ad", ad)
      document.getElementById('button-addon2').setAttribute("recipient", recipient)

      // using promises just to chose when to scroll: only if the previous snapshot of the query is different from the new one -> line 216
      getMessages(sender, ad, recipient).then((data) => {
        console.log(data)
        scrollToBottom();
        num_rows = data.length;
      }).catch((err) => {
        swal('Attenzione', "Al momento non è possibile recuperare i messaggi. Riprova più tardi.", 'warning')
        console.log(err);
      })

      // set visualizzzato to true only to recipient's messages
      seeMessages(sender, ad, recipient)
    }

    const sendMessage = (btn) => {
      var recipient = btn.getAttribute('sender');
      var ad = btn.getAttribute('ad');
      var sender = btn.getAttribute('recipient')

      var text = document.getElementById('textinput').value;

      var date = new Date()

      if (text) {
        document.getElementById('chatbox').insertAdjacentHTML('beforeend', '<div class="media w-50 ml-auto mb-3"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white">' + text + '</p></div><p class="small text-muted">' + date.getHours() + ':' + date.getMinutes() + ' | ' + date.getDate() + ' ' + months[date.getMonth()] + '</p></div></div>');
        setLastMessage(text, recipient, ad, sender, true)

        $.ajax({
          type: 'POST',
          url: 'api/profile_ajax_calls.php',
          data: {
            messageHandler: true,
            recipient: recipient,
            adId: ad,
            message: text,
          },
          success: () => {
            document.getElementById('textinput').value = "";
          },
          error: ({
            responseJSON
          }) => {
            console.log(responseJSON);
            document.getElementById('chatbox').lastChild.innerHTML = "";
            swal("Attenzione", "C'è stato un errore con l'invio del messaggio. Riprova più tardi.", "error")
          }
        });
        scrollToBottom();
      } else {
        swal("Attenzione", "Inserisci un messaggio da inviare", "warning")
      }
    }
  </script>
</body>

</html>