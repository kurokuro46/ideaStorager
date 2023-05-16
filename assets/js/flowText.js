function doTweetAjax() {
    $.ajax({
        url: "handle/handleAjax.php",
        type: "POST",
        caches: false,
    }).done(function (response) {
        let res = JSON.parse(response);
        const randRange = (min, max) => Math.floor(Math.random() * (max - min + 1) + min);//ランダム関数
        let html = '';
        let container = $('.tweets-container');

        res.forEach(val => {
            html +=
            `<p style="animation-duration:`+ randRange(15,25) +`s;animation-delay:`+ randRange(1,15) +`s;">`
                + `${val['tweet']}`
                + `</p>`;
            
        });
        container.append(html);//流れるテキスト挿入

        let item = container.find('p');
        let cont_h = container.height();//コンテンツ高さ取得
        item.each(function(index) {
            $(this).css({
                top: randRange(0,cont_h-25),
                'font-size': randRange(15,25) + 'px',
            });
        });

    }).fail(function (xhr,textStatus,errorThrown) {
        alert('error');
    });
};

window.onload = function(){
    doTweetAjax();
};