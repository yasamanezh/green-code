<div>
    <div class="tab-content" id="pills-tabContent rtl">
        <div class="tab-pane fade show active rtl"
             id="tab-home" role="tabpanel"
             aria-labelledby="pills-home-tab">
        <livewire:front.product.layout.tab.description :id="$product->id" />
        </div>
        <div class="tab-pane fade rtl"
             id="tab-video" role="tabpanel"
             aria-labelledby="pills-video-tab">

        <livewire:front.product.layout.tab.video :id="$product->id" />
        </div>
        <div class="tab-pane fade rtl"
             id="tab-comment" role="tabpanel"
             aria-labelledby="pills-comment-tab">

        <livewire:front.product.layout.tab.comment :id="$product->id" />
        </div>
        <div class="tab-pane fade rtl"
             id="tab-question" role="tabpanel"
             aria-labelledby="pills-question-tab">
        <livewire:front.product.layout.tab.question :id="$product->id" />
        </div>
    </div>
    <livewire:front.product.layout.tab.add-comment :id="$product->id" />
</div>
