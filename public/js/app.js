url = location.origin;
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
token = $('meta[name="csrf-token"]').attr('content');

ga('create', 'UA-89541563-1', 'auto');
ga('send', 'pageview');

$('.dropbtn').css('cursor', 'pointer');


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

    $(document).on('click', '.dropdown-report li', function(e){
        var _that = $(this); 
        if (_that.hasClass('no-click')) {
            e.preventDefault();
            return false;
        }



        var post_id = _that.parent().data('post-id');
        var reason = _that.data('reason');
        //console.log(post_id, reason);
        data = {_token: token, post_id: post_id, report: reason}

        //console.log(post_id, reason);
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
                //console.log(post_id, reason);
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
                    //console.log(response)
                    // $('.load-part').removeClass('submit').before(response.content)
                    that.addClass('active');
                    //console.log(response.likes_count);
                    that.children('.likes_count').html(response.likes_count);
                } else {

                }

            }
        });
    })


    var text_tags = $('#text_tags');
    var select_tags = $('#select_tags')
    var gender = $('#gender_select_tags')
    var other = $('#other_tag_select_tags')
    var story_body = $('#story_body')
    // var unhashed_text = $('#unhashed_text');
    var hidden_tag_input = $('#hidden_tag_input');
    var hidden_plain_content_input = $('#hidden_plain_content_input');
    var banned = [];

    /*Extract tags and display in bottom*/
    $(document).on('keyup', '#story_body', function(event){
        makeTags();
    })

    /*Remove a tag*/
    $(document).on('click', '.del_tags', function(event){
        var _that = $(this); 
        banned.push(_that.parent().text().trim());
        _that.parent().remove();
        console.log(banned);
    })

    /*Gender and other update*/  
    $(document).on('change', '#gender_select_tags, #other_tag_select_tags', function(event){
        makeTags(); 
    })

    /*Make tags*/
    function makeTags() {
        text_tags.empty();
        // unhashed_text.empty();
        var story = story_body.val();
        var tagslistarr = story.split(' ');
        var arr=[];
        var plainText = [];
        $.each(tagslistarr,function(i,val){
            if(tagslistarr[i].indexOf('#') == 0){
                arr.push(tagslistarr[i]);  
            }else{
                plainText.push(tagslistarr[i]);
            }

        });
        // _that.val(plainText);
        // unhashed_text.text(plainText.join(' '));
        hidden_plain_content_input.val(plainText.join(' '));

        /*extract gender*/
        if (gender.val() != 'autre') {
            arr.push('#'+gender.val())
        }
        /*extract other*/
        if (other.val() != 'autre') {
            arr.push('#'+other.val())
        }

        /*make array unique*/
        uniqueArray = unique(arr);
        hidden_tag_input.val(uniqueArray.join(' '));

        /*Display tags for user to see*/
        $.each(uniqueArray, function(i, val){
            var tgg = 
                '<span class="tagger">' + val + 
                    '&nbsp;&nbsp;<i class="fa fa-times del_tags"></i>' + 
                '</span>';
            text_tags.append(tgg);
        })
    }

    /*Make unique tags*/
    function unique(array){
        return array.filter(function(el, index, arr) {
            return index === arr.indexOf(el);
        });
    }
})