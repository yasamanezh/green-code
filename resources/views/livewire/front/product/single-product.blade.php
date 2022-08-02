<div>
    <div class="container-main">
        <livewire:front.product.layout.breadcrumb :id="$product->id" />
        <div class="col-12">
            <article class="product">
                <livewire:front.product.layout.gallery :id="$product->id" />
                <livewire:front.product.layout.info :id="$product->id" />
            </article>
        </div>
        <div class="col-12">
            <div class="tabs pt-3">
                <div class="tabs-product">
                    <livewire:front.product.layout.tabs-wrapper  />
                    <livewire:front.product.layout.tab.index :id="$product->id" />
                </div>
            </div>
        </div>
        <livewire:front.product.layout.related :id="$product->id" />
    </div>
</div>
