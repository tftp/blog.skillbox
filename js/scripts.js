
  const avatarInput = document.querySelector('#user-avatar');
  const avatarClick = document.querySelector('#click-user-avatar');
  const textClick = document.querySelector('#click-user-text');
  const imgAvatar = document.querySelector('.card-img-top');
  const btnSave = document.querySelector('.btn-save');
  const textAreaDiv = document.querySelector('.text-area-div');
  const textArea = document.querySelector('.text-area');
  const textAreaMute = document.querySelector('.text-muted')

  avatarClick.addEventListener('click', evt => {
  avatarInput.click();
  });

  textClick.addEventListener('click', evt => {
  textAreaDiv.hidden = false;
  textClick.hidden = true;
  btnSave.hidden = false;
  checkTextArea();
  });

  textArea.addEventListener('keydown', checkTextArea);

  function checkTextArea() {
    textArea.value = textArea.value.substr(0, 254);
  }

  avatarInput.addEventListener('change', evt => {
    let file = evt.target.files[0];
    let reader = new FileReader;

    reader.onload = (evt) => {
      imgAvatar.src = evt.target.result;
    };

    reader.readAsDataURL(file);
    btnSave.hidden = false;
  });
