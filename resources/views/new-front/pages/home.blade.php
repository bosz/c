@extends('new-front.master')

@if(Request::has('search'))
    @section('title', 'XYStories : témoignages ' . @urldecode(Request::get('search')))
@else
    @section('title', 'XYStories, les stories X de la génération Y')
@endif

@section('main')
<style type="text/css">
    select{
        font-family: 'FontAwesome', 'Tahoma';
        background: transparent;
        border: 1px solid #f9674e; 
    }
    select, option{
        font-size: 16px; 
        padding: 4px 8px 4px 8px;
        color: #f9674e;
    }
    select option{
    }
</style>


<section>
    <div class="search">
        <form class="form" >
            <button type="submit" class="searchBtn"><i class="fa fa-search"></i></button>
            <input type="search" name="search" class="searchField" placeholder="Recherche:" value="{{Request::get('search')}}">
            <!-- <ul class="searchField" placeholder="Recherche:"></ul> -->
        </form>
    </div>
    <div class="innerContainer">
        
        <div class="mainSection">
            <form action="{{url('site-post')}}" method="POST">
                <div>
                    <h3>Ecris ta story</h3>
					 <span style="color:#41ca31;">{{ Session::get('success') }}</span> 
					 <span style="color:#f9674e;">{{$errors->first('content')}}</span> 
                    <img id="pen" style="position: absolute; margin: 5px; display: block;" src="https://cdn1.iconfinder.com/data/icons/hawcons/32/698982-icon-135-pen-angled-128.png" width="20">
                    {{csrf_field()}}
					 <textarea name="content" onblur="$('#pen').show(); $('#story_body').css('height', '15px');" style="width: 97%; border: 1px solid red; margin-bottom: 20px; padding: 5px; height: 15px;" onfocus="$('#pen').hide(); $('#story_body').css('height', '70px');" id="story_body"></textarea>
                     <input type="hidden" name="hidden_tags" id="hidden_tag_input">
					
				   <input  class="textBox pass" type="hidden" value="" name="tags" />
                    <div style="margin-top:-15px; text-align:center; align:center">
                        <span style="color:red">
                            <select name="gender" id="gender_select_tags" class="form-control" >
                                <option value="homme">&#xf228; homme</option>
                                <option value="femme">&#xf224; femme </option>
                                <option value="autre" >autre</option>
                            </select>
                            <select name="other_tag" id="other_tag_select_tags" class=" form-control">
                                <option value="hétéro">hétéro</option>
                                <option value="homo">homo </option>
                                <option value="bi">bi &#xf221;</option>
                                <option value="autre" >autre</option>
                            </select>
                        </span>
                        <button style="margin-left: 20px; width:80px" name="submit" type="submit" class="submit">Poster</button>
                    </div>
                    <textarea rows="4" style="border: 1px solid rgb(237, 237, 237); width: 100%;margin-left: auto; margin-right: auto; padding: 4px;" name="plain_content" id="hidden_plain_content_input"></textarea>

                    <div style="width: 99%; margin-bottom: 5px; margin-left: auto; margin-right: auto; padding: 4px;">
                        <span id="text_tags"></span>
                        <span id="select_tags"></span>
                    </div>
                    
                </div>
            </form>
            @include('new-front.partials.sidebar')
            <div class="stories">
                <div class="center">
                    <div class="headings">
                        <h3 class="h11">
                        @if(Request::has('search'))
                            <small>Recherche {{ Request::get('search') }}</small>
                        @else
                        <a href="{{URL::to('/')}}" @if(Request::is('/')) style="color: #f9674e;" @else style="color: #ededed" @endif >Last stories</a>

                        @endif
                        </h3>
                        <h3 class="h22">
                        <a href="{{URL::to('top-posts')}}" @if(Request::is('top-posts')) style="color: #f9674e;" @else style="color: #ededed" @endif >Top stories</a></h3>
                    </div>
                    <article class="question"></article>
                    @if(@sizeof($posts) > 0)
                        @foreach(array_chunk($posts->all(), 3) as $post)
                            @include('new-front.partials.posts')
                        @endforeach
                    @else
                        <center><h1>No Post Matches Search {{Request::get('search')}} </h1></center>
                    @endif
                    <div class="load-part clearfix pagination"><center><h4>Loading . . .</h4></center></div>
                    <div class="emptyArea">
                        <span><i class="fa fa-venus-mars"></i>&nbsp;&nbsp;<i class="fa fa-transgender"></i>&nbsp;&nbsp;<i class="fa fa-venus"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottomSection">
        <div class="bottomLogo">
            <img src="{{ asset('nova_files/logo2.png') }}">
        </div>
    </div>
</section>

@endsection

@section('js')
<script src="{{ asset('js/init.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var tags = <?php echo json_encode($tags); ?>;
        var availableTags = new Array();
        $.each(tags, function(k, v){
            availableTags.push(v.title);
        })
        // console.log(window.location.pathname)
    });
</script>
@endsection