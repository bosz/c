url = location.origin;
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
token = $('meta[name="csrf-token"]').attr('content');

ga('create', 'UA-89541563-1', 'auto');
ga('send', 'pageview');

$('.dropbtn').css('cursor', 'pointer');



window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

$(document).ready(function() {

    /**/
    $('.carousel').carousel({
        interval: 4000 //changes the speed
    });

    /*Scroll event to make sticker header*/
    $(window).scroll(function() {
        var sticker = $('#sticker');
        var spacer = $('.spacer');
        var section = $('section');
        var itm = $('.itm');
        // var defacto = $('.defacto');
        // var to_hide = $('.to_hide')

        var scrollHeight = $('body').scrollTop(); 
        if (scrollHeight > 330) {
            spacer.css({'transition': '0.5s', 'height': '70px'})
            sticker.css({'transition': '0.5s', 'height': '100px', 'position': 'fixed'})
            itm.css({'visibility': 'visible'});
            // defacto.removeClass('pull-right').removeClass('pull-left');
            // to_hide.css({'visibility': 'hidden'});
        }else{
            spacer.css({'transition': '0.5s', 'height': 'auto'})
            sticker.css({'transition': '0.5s', 'height': 'auto', 'position': 'relative'})
            itm.css({'visibility': 'hidden'});
            // to_hide.css({'visibility': 'visible'});
        }
    })

    $(document).on('click', '.dropbtn', function(event){
        var _that = $(this);
        if(_that.parent().children('div').hasClass('show')){
            $('.dropdown-content').removeClass('show');
        }else{
            $('.dropdown-content').removeClass('show');
            _that.parent().children('div').addClass('show');
        }
    })

    $(document).on('click', '.dropdown-content a', function(e){
        var _that = $(this); 
        if (_that.hasClass('no-click')) {
            e.preventDefault();
            return false;
        }



        var post_id = _that.parent().data('post-id');
        var reason = _that.data('reason');
        console.log('tokennn ', token);
        data = {_token: token, post_id: post_id, report: reason}

        console.log(post_id, reason);
        $.ajax({
            type: "POST",
            url: url + '/post/report',
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    alert(response.message)
                    _that.remove();
                } else {
                    alert(response.message)
                }
                console.log(post_id, reason);
            }
        });
    })

    /*Ajax call for likes*/
    $(document).on('click', '.heart', function(event){
        var that = $(this);
        if (that.hasClass('active')) { //Has already been liked
            return false;
        }
        var post_id = that.data('post-id');
        data = {_token: token, post_id: post_id}

        $.ajax({
            type: "POST",
            url: url + '/post/like/store',
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    console.log(response)
                    // $('.load-part').removeClass('submit').before(response.content)
                    that.addClass('active');
                    console.log(response.likes_count);
                    that.children('.likes_count').html(response.likes_count);
                } else {

                }

            }
        });
    })
})