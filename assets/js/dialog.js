var dialog = document.querySelector('dialog');
var btn_show = document.getElementById('dialog-show');
const btn_close = document.getElementsByClassName('dialog-close');

btn_show.addEventListener('click', function() {
  dialog.showModal();
}, false);

for(let i=0; i<btn_close.length; i++){
    btn_close[i].addEventListener('click', function(){
        dialog.close();
    });
}