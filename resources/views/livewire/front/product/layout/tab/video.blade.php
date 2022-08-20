<div>
     <article class="card">

            <section class="content-expert-summary">
                <div class="mask pm-3">
                    <div class="mask-text">

                        @foreach($product->videos as $video)
                            <p>

                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$video->id}}" aria-expanded="false" aria-controls="collapseExample">
                                   {{$video->title}}
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample{{$video->id}}">
                                <div class="card card-body">
                                    {!! $video->description !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </article>
</div>
