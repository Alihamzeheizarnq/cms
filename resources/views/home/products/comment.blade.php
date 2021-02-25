
        @foreach($comments as $comment)
        <div class="media">
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    <li><i class="fa fa-calendar"></i>{{ $comment->user->is_superuser != 0 ? 'admin' : '' }}</li>
                </ul>
                <p >{{ $comment->comment }}</p>



                <a class="btn btn-primary" href="?parent={{ $comment->id }}"><i class="fa fa-reply"></i>Replay</a>
            </div>
        </div>

        <div class="media second-media">
            @include('home.products.comment' , ['comments' => $comment->child])
        </div>
        @endforeach
