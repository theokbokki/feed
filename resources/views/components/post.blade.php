<div class="post {{ rand(0, 3) ? 'post--left' : 'post--right' }}">
    @if($post->has('attachments'))
        @foreach($post->attachments as $attachment)
            <img class="post__attachment" src="{{ 'storage/'.$attachment->src }}" alt=""/>
        @endforeach
    @endif
    <p class="post__content">{!! nl2br($post->content) !!}</p>
</div>
