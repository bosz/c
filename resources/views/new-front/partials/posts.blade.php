@if(isset($post[0]))
<div class="box pst oneBox" style="width:100%; float:left; position:relative; margin:0px;">
    <!-- {{$post[0]->id}} -->
    <div class="center">
        <div class="text2">{!! $post[0]->content !!}</div>
        <span class="tags"  style="font-size:12px">
            <?php $tags = explode(',', $post[0]->tags);
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if ($tag == "") {
                    continue;
                }
                $t = urlencode('#'.trim($tag));
                echo '<a href="?search='.$t.'" data-tag="'.$tag.'" >#' . $tag . '</a> ';
            }
            ?>
        </span>
       
        <div class="container-flud post-other-details">
            <!-- <strong>{{$post[0]->author}}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
            <small><font color=grey>{{  $post[0]->created_at->diffForHumans() }}</font></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- <small>{{  $post[0]->count }} vues</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
            <!-- <i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
            <!-- <i class="fa fa-twitter"></i> -->
        </div>
        <div class="icons iconss">
            <span class="leftIcon" style="width:35%;">
            <div class="dropdown">
                <i class="fa fa-ban dropbtn" ></i>
                <div class="dropdown-content" data-post-id="{{$post[0]->id}}">
                    <a href="" class="no-click" ><center><i class="fa fa-warning"></i> REPORT</center></a>
                    <a data-reason="Contenu raciste">Contenu raciste</a>
                    <a data-reason="Contenu sexiste">Contenu sexiste</a>
                    <a data-reason="Contenu vulgaire">Contenu vulgaire</a>
                    <a data-reason="Contenu non-approprié">Contenu non-approprié</a>
                    <a data-reason="Autres">Autres</a>
                </div>
            </div>
            &nbsp;
			 <a href="{{url('post/')}}/{{ App\Libs\Custom::makePostURL($post[0]->id, $post[0]->content) }}"><img src="{{URL::asset('images/1484179391_back.png')}}" width="18">&nbsp;<span style="color:#3d3d3d;font-size:13px !important">partager</span></a></span>
            <span class="heart {{$post[0]->liked == true ? 'active' : null }}" data-post-id={{$post[0]->id}}><i class="likes_count">{{ $post[0]->likes_count != NULL ? $post[0]->likes_count : 0 }}</i><i class="fa fa-heart" style="width:35px; height:35px; line-height:35px;text-align:center; background:#ededed; border-radius:50%;"></i></span>
            <span class="rightIcon"><i class="fa fa-mars" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
@endif
<div class="twoBoxes">
    @if(isset($post[1]))
    <div class="box box2 pst" style="float:left;">
        <!-- {{$post[1]->id}} -->
        <div class="center">
            <div class="text2">{!! $post[1]->content !!}</div>
            <span class="tags" style="font-size:12px">
            <?php $tags = explode(',', $post[1]->tags);
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if ($tag == "") {
                    continue;
                }
                $t = urlencode('#'.trim($tag));
                echo '<a href="?search='.$t.'" data-tag="'.$tag.'" >#' . $tag . '</a> ';
            }
            ?>
            </span>
           
            <div class="container-flud post-other-details">
                <!-- <strong>{{$post[1]->author}}</strong> &nbsp;&nbsp; -->
                <small><font color=grey>{{  $post[1]->created_at->diffForHumans() }}</font></small>&nbsp;&nbsp;
                <!-- <small>{{  $post[1]->count }} vues</small>&nbsp;&nbsp; -->
                <!-- <i class="fa fa-facebook"></i>&nbsp;&nbsp; -->
                <!-- <i class="fa fa-twitter"></i> -->
            </div>
            <div class="icons">
                <span class="leftIcon" style="width:35%;">
                <div class="dropdown">
                <i class="fa fa-ban dropbtn" ></i>
                <div class="dropdown-content" data-post-id="{{$post[1]->id}}">
                    <a href="" class="no-click" ><center><i class="fa fa-warning"></i> REPORT</center></a>
                    <a data-reason="Contenu raciste">Contenu raciste</a>
                    <a data-reason="Contenu sexiste">Contenu sexiste</a>
                    <a data-reason="Contenu vulgaire">Contenu vulgaire</a>
                    <a data-reason="Contenu non-approprié">Contenu non-approprié</a>
                    <a data-reason="Autres">Autres</a>
                </div>
            </div>
                &nbsp;
			 <a href="{{url('post/')}}/{{ App\Libs\Custom::makePostURL($post[1]->id, $post[1]->content) }}"><img src="{{URL::asset('images/1484179391_back.png')}}" width="18">&nbsp;<span style="color:#3d3d3d;font-size:13px !important">partager</span></a></span>
                <span class="heart {{$post[1]->liked == true ? 'active' : null }}" data-post-id={{$post[1]->id}}><i class="likes_count">{{ $post[1]->likes_count != NULL ? $post[1]->likes_count : 0 }}</i><i class="fa fa-heart red" style="width:35px; height:35px; line-height:35px;text-align:center; background:#ededed; border-radius:50%;"></i></span>
                <span class="rightIcon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    @endif

    @if(isset($post[2]))
    <div class="box box2 pst" style="float:right;">
        <!-- {{$post[2]->id}} -->
        <div class="center">
            <div class="text2">{!! $post[2]->content !!}</div>
            <span class="tags" style="font-size:12px">
            <?php $tags = explode(',', $post[2]->tags);
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if ($tag == "") {
                    continue;
                }
                $t = urlencode('#'.trim($tag));
                echo '<a href="?search='.$t.'" data-tag="'.$tag.'" >#' . $tag . '</a> ';
            }
            ?>
            </span>
        
            <div class="container-flud post-other-details">
                <!-- <strong>{{$post[2]->author}}</strong> &nbsp;&nbsp; -->
                <small><font color=grey>{{  $post[2]->created_at->diffForHumans() }}</font></small>&nbsp;&nbsp;
                <!-- <small>{{  $post[2]->count }} vues</small>&nbsp;&nbsp; -->
                <!-- <i class="fa fa-facebook"></i>&nbsp;&nbsp; -->
                <!-- <i class="fa fa-twitter"></i> -->
            </div>
            <div class="icons">
                <span class="leftIcon" style="width:35%;">
                <div class="dropdown">
                <i class="fa fa-ban dropbtn" ></i>
                <div class="dropdown-content" data-post-id="{{$post[2]->id}}">
                    <a href="" class="no-click" ><center><i class="fa fa-warning"></i> REPORT</center></a>
                    <a data-reason="Contenu raciste">Contenu raciste</a>
                    <a data-reason="Contenu sexiste">Contenu sexiste</a>
                    <a data-reason="Contenu vulgaire">Contenu vulgaire</a>
                    <a data-reason="Contenu non-approprié">Contenu non-approprié</a>
                    <a data-reason="Autres">Autres</a>
                </div>
            </div>
                &nbsp;
				<a href="{{url('post/')}}/{{ App\Libs\Custom::makePostURL($post[2]->id, $post[2]->content) }}""><img src="{{URL::asset('images/1484179391_back.png')}}" width="18">&nbsp;<span style="color:#3d3d3d;font-size:13px !important">partager</span></a></span>
                <span class="heart {{$post[2]->liked == true ? 'active' : null }}" data-post-id={{$post[2]->id}}><i class="likes_count">{{ $post[2]->likes_count != NULL ? $post[2]->likes_count : 0 }}</i><i class="fa fa-heart" style="width:35px; height:35px; line-height:35px;text-align:center; background:#ededed; border-radius:50%;"></i></span>
                <span class="rightIcon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
    @endif
</div>