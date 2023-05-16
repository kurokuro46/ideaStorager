// つぶやき（tweet）DB更新
document.getElementById('tweet').onclick = function(){
    
    let tweet = $('#input-tweet').val();

    //デバック
    console.log(tweet);
    $.ajax({
        url: "handle/handleTweet.php",
        type: "post",
        dataType: "text",
        data:{'tweet': tweet}
    }).done(function (response) {

    }).fail(function (xhr,textStatus,errorThrown) {
        alert('error: tweet送信失敗');
    });
}
