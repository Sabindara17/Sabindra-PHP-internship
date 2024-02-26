<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>


    <input type="text" id="success" value="{{ session('success')}}" readonly hidden>
    <input type="text" id="error" value="{{ session('error')}}" readonly hidden>

    <div class="container">
            @foreach ($posts as $post)
            <div>
                <div class="title-div">
                    <h2>{{ $post->title }}</h2>
                    <small>{{ $post->description }}</small>
                    <div>
                        <span class="btn like-btn" data-id="{{ $post->id }}">Like</span>
                        <span class="btn comment-btn" data-id="{{ $post->id }}">Comment</span>
                    </div>
                        <div class="comment-div ms-3">
                        </div>
                </div>
            </div>
                @endforeach

    </div>
</x-app-layout>


<script>

$(document).ready(function() {
    $(".comment-btn").click(function(){
        let postid = $(this).attr('data-id');
        $.ajax({
            url: '',
            //post
                    success:function(result){
                        let message = JSON.parse(result);
                        if(message.status){
                            //add comment
                            //success message
                            //$(".comment-btn").append
                        }else{
                        //error message
                        }

                }})
    });
});
</script>
