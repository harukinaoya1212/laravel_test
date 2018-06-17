$(function()
{
    $('#touroku').click(function() //送信ボタンをクリック
    {
        // alert('saaa');
        $('#touroku').hide(1000);
         // alert($('#book_name').val());

            $.ajax({
                    type: "POST", //POSTで渡す
                    url: "/books", //POST先
                    data:
                        {
                            "book_name":$('#book_name').val(),
                            "book_number":$('#book_number').val(),
                            "book_amount":$('#book_amount').val(),
                            "book_published":$('#book_published').val()
                        },
                    success: function(hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
                    {
                        if(hoge==0) //返り値が0→成功
                        {
                            alert('正常終了しました');
                        }
                        else if(hoge==1) //返り値が1→失敗
                        {
                            alert('失敗しました');
                        }
                    },
                    error: function(XMLHttpRequest,textStatus,errorThrown) //通信失敗
                    {
                        alert('処理できませんでした');
                    }
                });
            return false; //ページが更新されるのを防ぐ
    });
});