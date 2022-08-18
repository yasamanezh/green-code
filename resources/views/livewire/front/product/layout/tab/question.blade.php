<div>
<div class="card">
        <div class="form-faq ">

            <div class="form-faq-row mt-3">
                <div class="form-faq-col">
                    <label>پرسش خود را مطرح کنید. </label>
                    <hr>
                    <div class="ui-textarea">
                        <textarea title="متن سوال" wire:model.defer="question"  class="ui-textarea-field"></textarea>
                        @error('question')
                        <span style="color: red">  {{$message}} </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="parent-btn lr-ds">
                <div class="form-faq-col form-faq-col-submit">
                    <a  wire:click.prevent="saveQuestion()" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">ثبت پرسش</a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

        <div id="product-questions-list">
            @foreach($questions as $value)
                <div id="product-questions-list">
                    <div class="questions-list">
                        <ul class="faq-list">
                            <li class="is-question">
                                <div class="section">
                                    <div class="faq-header">
                                        <span class="icon-faq">?</span>
                                    </div>
                                    پرسش:
                                    {{$value->question}}
                                    <div class="faq-date">
                                        <em> {{ verta($value->created_at)->format('%d/ %B  / %Y') }}</em>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if($value->answer)
                        <div class="questions-list answer-questions">
                            <ul class="faq-list">
                                <li class="is-question">
                                    <div class="section">
                                        <div class="faq-header">
                                            <span class="icon-faq"><i class="mdi mdi-storefront"></i></span>
                                        </div>
                                        <span class="pull-right"> پاسخ فروشنده :</span>
                                        <p>{{$value->answer}}</p>
                                        <div class="faq-date">
                                            <em>{{ verta($value->updated_at)->format('%d/ %B  / %Y') }}</em>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="position-relative pull-left">{{$questions->links()}}</div>
</div>
</div>
