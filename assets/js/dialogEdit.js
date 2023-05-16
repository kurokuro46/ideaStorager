const show_btns = document.querySelectorAll('.js-dialog-show');
show_btns.forEach((show_btn) => {
    show_btn.addEventListener('click', ({currentTarget}) => {
        const target = currentTarget.dataset.openDialog;
        const dialog = document.querySelector(`[data-dialog="${target}"]`);
        dialog.showModal();
        //スクロール禁止
        document.querySelector('body').style.setProperty('overflow', 'hidden');
    });
});

const close_btns = document.querySelectorAll('.js-dialog-close');
close_btns.forEach((close_btn) => {
    close_btn.addEventListener('click', ({currentTarget}) => {
        currentTarget.closest('dialog').close();
        dialog.showModal();
        //スクロール
        document.querySelector('body').style.setProperty('overflow', 'auto');
    });
});
