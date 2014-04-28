    $.ajaxSetup ({cache: false});

    $(document).ready(function() {
        var imageArray = [
            "ajax_loading.gif"
        ];

        $(imageArray).preload();
    });

    function cBox_Close(refresh) {
        if (refresh) {
            $.colorbox({
                onCleanup: function() {
                    window.location.reload();
                }
            });
        }
        $.colorbox.close();
    }

    $.fn.preload = function() {
        this.each(function(){
            $('<img/>')[0].src = "/images/" + this;
        });
    };