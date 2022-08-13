<div>

    <livewire:front.product.layout.gallery :id="$product->id"/>
    <livewire:front.product.layout.info :id="$product->id"/>
    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <div class="col-lg-12">
                    <livewire:front.product.layout.tabs-wrapper  />
                    <livewire:front.product.layout.tab.index :id="$product->id" />
                </div>
            </div>
        </div>
    </div>


</div>
