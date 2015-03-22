$(function(){

    $('.ajax-button').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.data('url');
        var state = $this.data('state');
        var success = $this.data('success');
        var data = $this.data();
        for(var i in data){
            if(['url','state','success'].indexOf(i) !== -1)
                data[i] = undefined;
        }
        data[yii.getCsrfParam()] = yii.getCsrfToken();
        $this.text(state);
        $.ajax({
            url: url,
            data: data,
            method: 'post',
            success: function(data) {
                $this.text(success);
            }
        })
    });

});