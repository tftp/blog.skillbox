
  const avatarInput = document.querySelector('#user-avatar');
  const avatarClick = document.querySelector('#click-user-avatar');
  const textClick = document.querySelector('#click-user-text');
  const imgAvatar = document.querySelector('.card-img-top');
  const btnSave = document.querySelector('.btn-save');
  const textAreaDiv = document.querySelector('.text-area-div');
  const textArea = document.querySelector('.text-area');
  const textAreaMute = document.querySelector('.text-muted');
  const btnSubscribe = document.querySelector('.btn-subscribe');

  if(btnSubscribe) {
    btnSubscribe.addEventListener('click', evt => {
      evt.preventDefault();
      let subscribe = evt.target.dataset.subscribe;
      let url = '/subscribe/update';
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
