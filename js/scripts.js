  const avatarInput = document.querySelector('#user-avatar');
  const avatarClick = document.querySelector('#click-user-avatar');
  const textClick = document.querySelector('#click-user-text');
  const imgAvatar = document.querySelector('.card-img-top');
  const btnSave = document.querySelector('.btn-save');
  const textAreaDiv = document.querySelector('.text-area-div');
  const textArea = document.querySelector('.text-area');
  const textMute = document.querySelector('.text-muted-subscribe');
  const btnSubscribe = document.querySelector('.btn-subscribe');
  const formSubscribe = document.querySelector('.form-subscribe');
  const imgNoteNew = document.querySelector('.img-note-new');
  const selectUserRole = document.querySelector('.user-role');
  const commentStatus = document.querySelector('.comment-status-update');
  const adminPagination = document.querySelector('.admin-pagination-select');
  const tableSubscribers = document.querySelector('.table-subscribers');

  if(adminPagination) {
    const buttonPagination = document.querySelector('.admin-pagination-button');
    adminPagination.addEventListener('change', evt => {
      buttonPagination.click();
    });
  }

  if(tableSubscribers) {
    const alert = document.querySelector('.alert');

    tableSubscribers.addEventListener('click', evt => {
      if(evt.target.dataset.secret) {
        let secret = evt.target.dataset.secret;
        let parent = evt.target.parentNode.parentNode;
        let url = '/admin/subscribers/delete';
        let param = new URLSearchParams({"secret": secret});

        alert.classList.remove("alert", "alert-success", "alert-danger");

        sendRequest(url, param).then((result) => {
            if(result) {
              parent.remove();
              alert.classList.add("alert", "alert-success");
              alert.innerText = "Успешно удалено";
            } else {
              alert.classList.add("alert", "alert-danger");
              alert.innerText = "Ошибка удаления";
            }
        });
      }
    });
  }

  if(commentStatus) {
    commentStatus.addEventListener('change', evt => {
      if(evt.target.dataset.id) {
        let id = evt.target.dataset.id;
        let parent = evt.target.parentNode.parentNode;
        let url = '/comments/update';
        let status = evt.target.value;
        let param = new URLSearchParams({"id": id, "status": status});

        sendRequest(url, param).then((result) => {
          if(result) {
            parent.classList.remove("table-success", "table-danger", "table-warning");

            if(status == 0) {
              parent.classList.add("table-warning");
            }

            if(status > 0) {
              parent.classList.add("table-success");
            }

            if(status < 0) {
              parent.classList.add("table-danger");
            }
          }
        });
      }
    });
  }

  if(selectUserRole) {
    selectUserRole.addEventListener('change', evt => {
      let id = evt.target.dataset.id;
      let role = evt.target.value;
      let url = '/admin/users/update';
      let param = new URLSearchParams({"id": id, "role": role});

      sendRequest(url, param).then((result) => {
        if(!result) {
          window.location.replace('/');
        } else {
          alert('Успешно изменено');
        }
      });
    });
  }

  if(imgNoteNew) {
    const imgInput = document.querySelector('#imgInput');

    imgNoteNew.addEventListener('click', evt => {
      imgInput.click();
    });

    imgInput.addEventListener('change', evt => {
      let file = evt.target.files[0];
      let reader = new FileReader;

      reader.onload = (evt) => {
        imgNoteNew.src = evt.target.result;
      };

      reader.readAsDataURL(file);
    });
  }

  if(formSubscribe) {
      const btnSubscribeMain = document.querySelector('.btn-subscribe-main');

      btnSubscribeMain.addEventListener('click', evt => {
        evt.preventDefault();

        let form = new FormData(formSubscribe);
        let url = evt.target.dataset.id ? '/users/subscribe/update' : '/subscribe/update';

        sendRequest(url, form).then((result) => {
          if(evt.target.dataset.id) {
            formSubscribe.hidden = true;
          }
          textMute.innerText = result["message"];

          if(evt.target.classList.contains("admin") && result["success"]) {
            location.reload();
          }
        });
      });
  }

  if(btnSubscribe) {
    btnSubscribe.addEventListener('click', evt => {
      evt.preventDefault();
      let subscribe = evt.target.dataset.subscribe;
      let url = '/users/subscribe/update';
      let param = new URLSearchParams({"subscribe": subscribe});

      sendRequest(url, param).then((result) => {
        if(result == 0) {
          evt.target.dataset.subscribe = 0;
          evt.target.innerText = 'Подписаться';
        } else {
          evt.target.dataset.subscribe = 1;
          evt.target.innerText = 'Отписаться';
        }
      });
    });
  }

  if(avatarClick) {
    avatarClick.addEventListener('click', evt => {
    avatarInput.click();
    });
  }

  if(textClick) {
    textClick.addEventListener('click', evt => {
    textAreaDiv.hidden = false;
    textClick.hidden = true;
    btnSave.hidden = false;
    checkTextArea();
    });
  }

  if(textArea) {
    textArea.addEventListener('keydown', checkTextArea);
  }

  if(avatarInput) {
    avatarInput.addEventListener('change', evt => {
      let file = evt.target.files[0];
      let reader = new FileReader;

      reader.onload = (evt) => {
        imgAvatar.src = evt.target.result;
      };

      reader.readAsDataURL(file);
      btnSave.hidden = false;
    });
  }

  function checkTextArea() {
    textArea.value = textArea.value.substr(0, 254);
  }

  async function sendRequest(url, data) {
  let response = await fetch(url, {
    method: 'POST',
    body: data,
  });
  let result = await response.json();
  return result;
}
