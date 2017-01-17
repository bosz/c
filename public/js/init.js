isAjaxCalled = false;
token = $('meta[name="csrf-token"]').attr('content');
url = location.origin;

offset = 10;

isAjaxCalled = true;
isActive = false;

$(document).ready(function() {

    $(window).scroll(function() {
        if (isAjaxCalled) {
            var hT = $('.load-part').offset().top,
                hH = $('.load-part').outerHeight(),
                wH = $(window).height(),
                wS = $(this).scrollTop();
            if (wS > (hT + hH - wH) && !isActive) {
                isActive = true;
                $('.load-part').addClass('submit');

                data = {_token: token, offset: offset};

                if (location.search != 0){
                    var search = location.search.split('=')[1]; 
                    if (search != "") {
                        data.search = search;
                    }
                }

                var fullUrl = url; 
                if (window.location.pathname == '/top-posts') {
                    fullUrl += '/post/top-posts-paginate';
                }else if(window.location.pathname == '/') {
                    fullUrl += '/post/paginate';
                }

                $.ajax({
                    type: "POST",
                    url: fullUrl,
                    data: data,
                    success: function(response) {
                        if (response.status == 'success') {
                            isAjaxCalled = true;
                            $('.load-part').removeClass('submit').before(response.content)
                            offset += 10;
                        } else {

                            isAjaxCalled = false;

                            $('.load-part').removeClass('submit');

                            $('.load-part').html('<br><br><h2 style="color:grey; font-weight: bold;"><center><small>' + response.message + '</small></center></h2>')
                        }
                        isActive = false;

                    }
                });
                // isActive = false

            }
        }
    });
});

$(function() {
    $('.navigation_mobile').on('click', function() {
        $(this).find('ul').slideToggle()
    })
});

